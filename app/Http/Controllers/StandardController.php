<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Standard;
use App\Models\Training;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StandardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:standards create')->only(['create', 'store']);
        $this->middleware('can:standards read')->only(['index']);
        $this->middleware('can:standards update')->only(['edit', 'update']);
        $this->middleware('can:standards delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $standards = Standard::latest()->get();
        $training = Training::first();
        if (!$training) {
            Training::create([
                'title' => 'title',
                'description' => 'description'
            ]);
        }

        return view('admin.trainings.index', compact('training'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trainings.create');
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
            'name' => ['required', 'string', 'unique:standards,name', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['required', 'file', 'image']
        ]);

        $body = $request->content;

        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
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

                        Storage::put('public/services/images/' . $imageName, $decoded);

                        $image->setAttribute('src', asset('storage/services/images/' . $imageName));
                    } {
                        // not base64 image
                    }
                }
            }
        }

        $body = $dom->saveHTML();

        $image = $request->file('image');
        $path = Storage::disk('public')->putFile('standards', new File($image));

        Standard::create([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $body,
            'image' => $path
        ]);

        // $blog = Blog::create([
        //     'title' => $request->title,
        //     'body' => $body,
        //     'slug' => 'slug'
        // ]);

        // $slug = Str::of($request->title)->slug('-');

        // $blog->update([
        //     'slug' => $slug
        // ]);

        return redirect()->route('admin.trainings.index')->with('success', 'Standard created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $standard = Standard::findOrFail($id);
        $services = [];
        $servicesRaw = Service::latest()->get();
        foreach ($servicesRaw as $servicex) {
            $dom = new DOMDocument();
            @$dom->loadHTML($servicex->short_description, LIBXML_HTML_NODEFDTD);

            $text = $dom->textContent;
            $x = $servicex;
            $x['short_description_text'] = $text;
            array_push($services, $x);
        }
        $services = json_decode(json_encode($services));

        return view('admin.trainings.show', compact('standard', 'services'));
    }

    public function indexPublic()
    {
        $training = Training::first();
        if (!$training) {
            Training::create([
                'title' => 'title',
                'description' => 'description'
            ]);
        }
        $standards = Standard::latest()->get();
        $services = [];
        $servicesRaw = Service::latest()->get();
        foreach ($servicesRaw as $servicex) {
            $dom = new DOMDocument();
            @$dom->loadHTML($servicex->short_description, LIBXML_HTML_NODEFDTD);

            $text = $dom->textContent;
            $x = $servicex;
            $x['short_description_text'] = $text;
            array_push($services, $x);
        }
        $services = json_decode(json_encode($services));

        return view('admin.trainings.indexPublic', compact('standards', 'services', 'training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $standard = Standard::findOrFail($id);

        return view('admin.trainings.edit', compact('standard'));
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
            'name' => ['required', 'string', 'max:255', Rule::unique('standards', 'name')->ignore($id)],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['file', 'image']
        ]);

        $standard = Standard::findOrFail($id);

        // content
        $oldImages = [];
        $newImages = [];

        // start old images sorting
        $body = $standard->content;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/services/images')) {
                    $imageName = explode('storage/services/images/', $data)[1];

                    array_push($oldImages, $imageName);
                }
            }
        }
        // end old images sorting

        // start new images sorting
        $body2 = $request->content;
        $dom2 = new DOMDocument();
        @$dom2->loadHTML($body2, LIBXML_HTML_NODEFDTD);
        $images2 = $dom2->getElementsByTagName('img');

        if ($images2->count() >= 1) {
            foreach ($images2 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/services/images')) {
                    $imageName = explode('storage/services/images/', $data)[1];

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
        $body3 = $request->content;
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

                        Storage::put('public/services/images/' . $imageName, $decoded);

                        $image->setAttribute('src', asset('storage/services/images/' . $imageName));
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
            Storage::delete('public/services/images/' . $image);
        }
        // end delete unused images

        // $slug = Str::of($request->title)->slug('-');

        // $blog->update([
        //     'title' => $request->title,
        //     'body' => $body3,
        //     'slug' => $slug
        // ]);

        // thumbnail
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($standard->image)) {
                Storage::disk('public')->delete($standard->image);
            }
            $image = $request->file('image');
            $path = Storage::disk('public')->putFile('standards', new File($image));
        }

        $standard->update([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $body3,
            'image' => $request->hasFile('image') ? $path : $standard->image,
        ]);

        return redirect()->route('admin.trainings.index')->with('success', 'Standard updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $standard = Standard::findOrFail($id);

        Storage::disk('public')->delete($standard->image);

        $body = $standard->content;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/services/images')) {
                    $imageName = explode('storage/services/images/', $data)[1];

                    Storage::delete('public/services/images/' . $imageName);
                }
            }
        }

        $standard->delete();

        return redirect()->route('admin.trainings.index')->with('success', 'Standard deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $standard = Standard::findOrFail($id);
            // array_push($images, $standard->image);
            $body = $standard->content;
            $dom = new DOMDocument();
            @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            if ($images->count() >= 1) {
                foreach ($images as $image) {
                    $data = $image->getAttribute('src');

                    if (str_contains($data, 'storage/services/images')) {
                        $imageName = explode('storage/services/images/', $data)[1];

                        Storage::delete('public/services/images/' . $imageName);
                    }
                }
            }

            Storage::disk('public')->delete($standard->image);
            $standard->delete();
        }

        // Standard::destroy($arr);
        // Storage::disk('public')->delete($images);

        return redirect()->route('admin.trainings.index')->with('success', 'Bulk delete success');
    }

    public function updateTraining(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'image' => ['file', 'image']
        ]);

        // return $request;

        $standard = Training::first();

        // content
        $oldImages = [];
        $newImages = [];

        // start old images sorting
        $body = $standard->description;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/trainings/images')) {
                    $imageName = explode('storage/trainings/images/', $data)[1];

                    array_push($oldImages, $imageName);
                }
            }
        }
        // end old images sorting

        // start new images sorting
        $body2 = $request->description;
        $dom2 = new DOMDocument();
        @$dom2->loadHTML($body2, LIBXML_HTML_NODEFDTD);
        $images2 = $dom2->getElementsByTagName('img');

        if ($images2->count() >= 1) {
            foreach ($images2 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/trainings/images')) {
                    $imageName = explode('storage/trainings/images/', $data)[1];

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
        $body3 = $request->description;
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

                        Storage::put('public/trainings/images/' . $imageName, $decoded);

                        $image->setAttribute('src', asset('storage/trainings/images/' . $imageName));
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
            Storage::delete('public/trainings/images/' . $image);
        }
        // end delete unused images

        // $slug = Str::of($request->title)->slug('-');

        // $blog->update([
        //     'title' => $request->title,
        //     'body' => $body3,
        //     'slug' => $slug
        // ]);

        // thumbnail
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($standard->image)) {
                Storage::disk('public')->delete($standard->image);
            }
            $image = $request->file('image');
            $path = Storage::disk('public')->putFile('standards', new File($image));
        }

        $standard->update([
            'title' => $request->title,
            'description' => $body3,
            'image' => $request->hasFile('image') ? $path : $standard->image
        ]);

        return back()->with('success', 'Trainings updated');
    }
}
