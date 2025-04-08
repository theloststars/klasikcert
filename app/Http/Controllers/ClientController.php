<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:clients create')->only(['create', 'store']);
        $this->middleware('can:clients read')->only('index');
        $this->middleware('can:clients update')->only(['edit', 'update']);
        $this->middleware('can:clients delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'image' => ['required'],
            'image.*' => ['file', 'image']
        ]);

        $file = $request->file('image');
        foreach ($file as $image) {
            $path = Storage::disk('public')->putFile('clients', new File($image));
            Client::create([
                'image' => $path
            ]);
        }

        return redirect()->route('admin.clients.index')->with('success', 'Image uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit', compact('client'));
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
            'image' => ['required', 'file', 'image']
        ]);

        $client = Client::findOrFail($id);

        if (Storage::disk('public')->exists($client->image)) {
            Storage::disk('public')->delete($client->image);
        }

        $file = $request->file('image');
        $path = Storage::disk('public')->putFile('clients', new File($file));

        $client->update([
            'image' => $path
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Image updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if (Storage::disk('public')->exists($client->image)) {
            Storage::disk('public')->delete($client->image);
        }

        $client->delete();

        return back()->with('success', 'Image deleted');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $client = Client::find($id);
            if ($client) {
                array_push($images, $client->image);
            }
        }

        Client::destroy($arr);
        Storage::disk('public')->delete($images);

        return redirect()->back()->with('success', 'Bulk delete success');
    }
}