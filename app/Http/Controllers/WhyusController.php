<?php

namespace App\Http\Controllers;

use App\Models\Whyus;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyusController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:whyus create')->only(['create', 'store']);
        $this->middleware('can:whyus read')->only(['index']);
        $this->middleware('can:whyus update')->only(['edit', 'update']);
        $this->middleware('can:whyus delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $why = Whyus::latest()->get();

        return view('admin.whyus.index', compact('why'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.whyus.create');
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
        ]);

        // $short_description = $this->processCkeditorStore($request->short_description);

     Whyus::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            
        ]);

        return redirect()->route('admin.whyus.index')->with('success', 'Standard created');
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

                    Storage::put('public/whyus/images/' . $imageName, $decoded);

                    $image->setAttribute('src', asset('storage/whyus/images/' . $imageName));
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
        $whys = Whyus::findOrFail($id);
        $whyus = [];
        $whyusRaw = Whyus::latest()->get();
        foreach ($whyusRaw as $whysx) {
            $dom = new DOMDocument();
            @$dom->loadHTML($whysx->short_description, LIBXML_HTML_NODEFDTD);

            $text = $dom->textContent;
            $x = $whysx;
            $x['short_description_text'] = $text;
            array_push($whyus, $x);
        }
        $whyus = json_decode(json_encode($whyus));

        return view('admin.whyus.show', compact('whys', 'whyus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $why = Whyus::findOrFail($id);

        return view('admin.whyus.edit', compact('why'));
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
            
        ]);

        $whys = Whyus::findOrFail($id);

        

        $whys->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            
        ]);

        return redirect()->route('admin.whyus.index')->with('success', 'Why Us Content updated');
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

                if (str_contains($data, 'storage/whyus/images')) {
                    $imageName = explode('storage/whyus/images/', $data)[1];

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

                if (str_contains($data, 'storage/whyus/images')) {
                    $imageName = explode('storage/whyus/images/', $data)[1];

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

                        Storage::put('public/whyus/images/' . $imageName, $decoded);

                        $image->setAttribute('src', asset('storage/whyus/images/' . $imageName));
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
            Storage::delete('public/whyus/images/' . $image);
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
        $standard = Whyus::findOrFail($id);

        // Storage::disk('public')->delete($standard->thumbnail);

        $standard->delete();

        return redirect()->route('admin.whyus.index')->with('success', 'Why Us Content deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $standard = Whyus::findOrFail($id);

            // Storage::disk('public')->delete($standard->thumbnail);
            $standard->delete();
        }

        // Standard::destroy($arr);
        // Storage::disk('public')->delete($images);

        return redirect()->route('admin.whyus.index')->with('success', 'Bulk delete success');
    }
}
