<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FooterLogo;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:abouts create')->only(['create', 'store']);
        $this->middleware('can:abouts read')->only(['index']);
        $this->middleware('can:abouts update')->only(['edit', 'update']);
        $this->middleware('can:abouts delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::latest()->get();

        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required'],
            'description' => ['required'],
            'thumbnail' => ['required', 'file', 'image']
        ]);

        $short_description = $this->processCkeditorStore($request->short_description);
        $description = $this->processCkeditorStore($request->description);

        $file = $request->file('thumbnail');
        $path = Storage::disk('public')->putFile('abouts', new File($file));

        About::create([
            'title' => $request->title,
            'short_description' => $short_description,
            'description' => $description,
            'thumbnail' => $path
        ]);

        return redirect()->route('admin.abouts.index')->with('success', 'Standard created');
    }

    private function processCkeditorStore($field)
    {
        $body = $field;

        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'base64')) {
                    $extension = explode('/', mime_content_type($data))[1];
                    $data = explode(';', $data);
                    $data = explode(',', $data[1]);
                    // return $data;
                    $data = $data[1];

                    $decoded = base64_decode($data);
                    $imageName = uniqid() . '.' . $extension;

                    Storage::put('public/abouts/images/' . $imageName, $decoded);

                    $image->setAttribute('src', asset('storage/abouts/images/' . $imageName));
                }
            }
        }

        $body = $dom->saveHTML();

        return $body;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = About::findOrFail($id);
        $abouts = [];
        $aboutsRaw = About::latest()->get();
        foreach ($aboutsRaw as $aboutx) {
            $dom = new DOMDocument();
            @$dom->loadHTML($aboutx->short_description, LIBXML_HTML_NODEFDTD);

            $text = $dom->textContent;
            $x = $aboutx;
            $x['short_description_text'] = $text;
            array_push($abouts, $x);
        }
        $abouts = json_decode(json_encode($abouts));
        $footerlogos = FooterLogo::all();

        return view('admin.abouts.show', compact('about', 'abouts','footerlogos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);

        return view('admin.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required'],
            'description' => ['required'],
            'thumbnail' => ['file', 'image']
        ]);

        $about = About::findOrFail($id);

        $short_description = $this->processCkeditorUpdate($request, $about, 'short_description');
        $description = $this->processCkeditorUpdate($request, $about, 'description');

        // thumbnail
        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($about->thumbnail)) {
                Storage::disk('public')->delete($about->thumbnail);
            }
            $thumbnail = $request->file('thumbnail');
            $path = Storage::disk('public')->putFile('abouts', new File($thumbnail));
        }

        $about->update([
            'thumbnail' => $request->hasFile('thumbnail') ? $path : $about->thumbnail,
            'title' => $request->title,
            'short_description' => $short_description,
            'description' => $description
        ]);

        return redirect()->route('admin.abouts.index')->with('success', 'about updated');
    }

    private function processCkeditorUpdate($request, $model, $field)
    {
        // content
        $oldImages = [];
        $newImages = [];

        // start old images sorting
        $body = $model->$field;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/abouts/images')) {
                    $imageName = explode('storage/abouts/images/', $data)[1];

                    array_push($oldImages, $imageName);
                }
            }
        }
        // end old images sorting

        // start new images sorting
        $body2 = $request->$field;
        $dom2 = new DOMDocument();
        @$dom2->loadHTML($body2, LIBXML_HTML_NODEFDTD);
        $images2 = $dom2->getElementsByTagName('img');

        if ($images2->count() >= 1) {
            foreach ($images2 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/abouts/images')) {
                    $imageName = explode('storage/abouts/images/', $data)[1];

                    array_push($newImages, $imageName);
                }
            }
        }
        // end new images sorting

        // start unset $oldImages if new images appear in old images
        foreach ($newImages as $image) {
            if (($key = array_search($image, $oldImages)) !== false) {
                unset($oldImages[$key]);
            }
        }
        // end unset $oldImages if new images appear in old images

        // start upload new images
        $body3 = $request->$field;
        $dom3 = new DOMDocument();
        @$dom3->loadHTML($body3, LIBXML_HTML_NODEFDTD);
        $images3 = $dom3->getElementsByTagName('img');

        if ($images3->count() >= 1) {
            foreach ($images3 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'base64')) {
                    @$extension = explode('/', mime_content_type($data))[1];
                    if (@$extension) {
                        // base64 image
                        $data = explode(';', $data);
                        $data = explode(',', $data[1]);
                        $data = $data[1];

                        $decoded = base64_decode($data);
                        $imageName = uniqid() . '.' . $extension;

                        Storage::put('public/abouts/images/' . $imageName, $decoded);

                        $image->setAttribute('src', asset('storage/abouts/images/' . $imageName));
                    } else {
                        // not base64 image
                    }
                }
            }
        }

        $body3 = $dom3->saveHTML();
        // end upload new images

        // delete unused images
        foreach ($oldImages as $image) {
            Storage::delete('public/abouts/images/' . $image);
        }
        // end delete unused images

        return $body3;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $standard = About::findOrFail($id);

        Storage::disk('public')->delete($standard->thumbnail);

        $body = $standard->short_description;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/abouts/images')) {
                    $imageName = explode('storage/abouts/images/', $data)[1];

                    Storage::delete('public/abouts/images/' . $imageName);
                }
            }
        }

        $body2 = $standard->description;
        $dom2 = new DOMDocument();
        @$dom2->loadHTML($body2, LIBXML_HTML_NODEFDTD);
        $images2 = $dom2->getElementsByTagName('img');
        if ($images2->count() >= 1) {
            foreach ($images2 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/abouts/images')) {
                    $imageName = explode('storage/abouts/images/', $data)[1];

                    Storage::delete('public/abouts/images/' . $imageName);
                }
            }
        }

        $standard->delete();

        return redirect()->route('admin.abouts.index')->with('success', 'about deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $standard = About::findOrFail($id);
            $body = $standard->short_description;
            $dom = new DOMDocument();
            @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            if ($images->count() >= 1) {
                foreach ($images as $image) {
                    $data = $image->getAttribute('src');

                    if (str_contains($data, 'storage/abouts/images')) {
                        $imageName = explode('storage/abouts/images/', $data)[1];

                        Storage::delete('public/abouts/images/' . $imageName);
                    }
                }
            }

            $body2 = $standard->description;
            $dom2 = new DOMDocument();
            @$dom2->loadHTML($body2, LIBXML_HTML_NODEFDTD);
            $images2 = $dom2->getElementsByTagName('img');
            if ($images2->count() >= 1) {
                foreach ($images2 as $image) {
                    $data = $image->getAttribute('src');

                    if (str_contains($data, 'storage/abouts/images')) {
                        $imageName = explode('storage/abouts/images/', $data)[1];

                        Storage::delete('public/abouts/images/' . $imageName);
                    }
                }
            }

            Storage::disk('public')->delete($standard->thumbnail);
            $standard->delete();
        }

        // Standard::destroy($arr);
        // Storage::disk('public')->delete($images);

        return redirect()->route('admin.abouts.index')->with('success', 'Bulk delete success');
    }
}
