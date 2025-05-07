<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FooterLogo;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:blogs create')->only(['create', 'store']);
        $this->middleware('can:blogs read')->only(['index', 'show']);
        $this->middleware('can:blogs update')->only(['edit', 'update']);
        $this->middleware('can:blogs delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return view('blogs.index', compact('blogs'));
    }

    public function indexPublic()
    {
        $blogs = Blog::latest()->paginate(20);

        return view('blogs.public.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
            'title' => ['required', 'max:191'],
            'body' => ['required'],
            'thumbnail' => ['required', 'file', 'image'],
            'short_description' => ['required', 'string']
        ]);

        $body = $request->body;

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

                    Storage::put('public/blogs/images/' . $imageName, $decoded);

                    $image->setAttribute('src', asset('storage/blogs/images/' . $imageName));
                }
            }
        }

        $body = $dom->saveHTML();
        
        $file = $request->file('thumbnail');
        $path = Storage::disk('public')->putFile('blogs', new File($file));

        $blog = Blog::create([
            'title' => $request->title,
            'body' => $body,
            'slug' => 'slug',
            'short_description' => $request->short_description,
            'thumbnail' => $path
        ]);

        $slug = Str::of($request->title)->slug('-');

        $blog->update([
            'slug' => $slug
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog uploaded !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('blogs.showPublic', $id);
        // $blog = Blog::findOrFail($id);
        $footerlogos = FooterLogo::all();
        return view('blogs.show', compact('blog','footerlogos'));
    }

    public function showPublic($id)
    {
        $blog = Blog::findOrFail($id);
        $footerlogos = FooterLogo::all();
        return view('blogs.show', compact('blog','footerlogos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', compact('blog'));
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
            'title' => ['required', 'max:191'],
            'body' => ['required'],
            'thumbnail' => ['file', 'image'],
            'short_description' => ['required', 'string']
        ]);

        $blog = Blog::find($id);

        $oldImages = [];
        $newImages = [];

        // start old images sorting
        $body = $blog->body;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/blogs/images')) {
                    $imageName = explode('storage/blogs/images/', $data)[1];

                    array_push($oldImages, $imageName);
                }
            }
        }
        // end old images sorting

        // start new images sorting
        $body2 = $request->body;
        $dom2 = new DOMDocument();
        @$dom2->loadHTML($body2, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images2 = $dom2->getElementsByTagName('img');

        if ($images2->count() >= 1) {
            foreach ($images2 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/blogs/images')) {
                    $imageName = explode('storage/blogs/images/', $data)[1];

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
        $body3 = $request->body;
        $dom3 = new DOMDocument();
        @$dom3->loadHTML($body3, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images3 = $dom3->getElementsByTagName('img');

        if ($images3->count() >= 1) {
            foreach ($images3 as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'base64')) {
                    $extension = explode('/', mime_content_type($data))[1];
                    $data = explode(';', $data);
                    $data = explode(',', $data[1]);
                    $data = $data[1];

                    $decoded = base64_decode($data);
                    $imageName = uniqid() . '.' . $extension;

                    Storage::put('public/blogs/images/' . $imageName, $decoded);

                    $image->setAttribute('src', asset('storage/blogs/images/' . $imageName));
                }
            }
        }

        $body3 = $dom3->saveHTML();
        // end upload new images

        // delete unused images
        foreach ($oldImages as $image) {
            Storage::delete('public/blogs/images/' . $image);
        }
        // end delete unused images

        $slug = Str::of($request->title)->slug('-');

        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->putFile('blogs', new File($file));
        }

        $blog->update([
            'title' => $request->title,
            'body' => $body3,
            'slug' => $slug,
            'thumbnail' => $request->hasFile('thumbnail') ? $path : $blog->thumbnail,
            'short_description' => $request->short_description
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $body = $blog->body;
        $dom = new DOMDocument();
        @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->count() >= 1) {
            foreach ($images as $image) {
                $data = $image->getAttribute('src');

                if (str_contains($data, 'storage/blogs/images')) {
                    $imageName = explode('storage/blogs/images/', $data)[1];

                    Storage::delete('public/blogs/images/' . $imageName);
                }
            }
        }

        if (Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $id) {
            $blog = Blog::findOrFail($id);

            $body = $blog->body;
            $dom = new DOMDocument();
            @$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            if ($images->count() >= 1) {
                foreach ($images as $image) {
                    $data = $image->getAttribute('src');

                    if (str_contains($data, 'storage/blogs/images')) {
                        $imageName = explode('storage/blogs/images/', $data)[1];

                        Storage::delete('public/blogs/images/' . $imageName);
                    }
                }
            }

            if (Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $blog->delete();
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Posts deleted !');
    }
}
