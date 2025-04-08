<?php

namespace App\Http\Controllers;

use App\Models\FooterLogo;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterLogoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerlogos = FooterLogo::latest()->get();

        return view('admin.footerlogos.index', compact('footerlogos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.footerlogos.create');
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
            'thumbnail' => ['required', 'file', 'image']
        ]);


        $file = $request->file('thumbnail');
        $path = Storage::disk('public')->putFile('footerlogos', new File($file));

        FooterLogo::create([
            'title' => $request->title,
            'thumbnail' => $path
        ]);

        return redirect()->route('admin.footerlogos.index')->with('success', 'Footer Logo created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footerlogo = FooterLogo::findOrFail($id);

        return view('admin.footerlogos.edit', compact('footerlogo'));
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
            'thumbnail' => ['file', 'image']
        ]);

        $footerlogo = FooterLogo::findOrFail($id);

        // thumbnail
        if ($request->hasFile('thumbnail')) {
            if (Storage::disk('public')->exists($footerlogo->thumbnail)) {
                Storage::disk('public')->delete($footerlogo->thumbnail);
            }
            $thumbnail = $request->file('thumbnail');
            $path = Storage::disk('public')->putFile('footerlogos', new File($thumbnail));
        }

        $footerlogo->update([
            'thumbnail' => $request->hasFile('thumbnail') ? $path : $footerlogo->thumbnail,
            'title' => $request->title,
        ]);

        return redirect()->route('admin.footerlogos.index')->with('success', 'footerlogo updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $footerlogo = FooterLogo::findOrFail($id);

        Storage::disk('public')->delete($footerlogo->thumbnail);

        $footerlogo->delete();

        return redirect()->route('admin.footerlogos.index')->with('success', 'footerlogo deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $footerlogo = FooterLogo::findOrFail($id);
            Storage::disk('public')->delete($footerlogo->thumbnail);
            $footerlogo->delete();
        }

        // Footer Logo::destroy($arr);
        // Storage::disk('public')->delete($images);

        return redirect()->route('admin.footerlogos.index')->with('success', 'Bulk delete success');
    }
}
