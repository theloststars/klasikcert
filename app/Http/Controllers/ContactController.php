<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->get();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts.create');
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
            'url_slug' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
        ]);


        Contact::create([
            'title' => $request->title,
            'url_slug' => $request->url_slug,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Data Contact created');
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
        $contact = Contact::findOrFail($id);

        return view('admin.contacts.edit', compact('contact'));
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
            'url_slug' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
        ]);

        $contact = Contact::findOrFail($id);

        $contact->update([
            'title' => $request->title,
            'url_slug' => $request->url_slug,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'contact updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);


        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'contact deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $contact = Contact::findOrFail($id);
            $contact->delete();
        }

        // Footer Logo::destroy($arr);
        // Storage::disk('public')->delete($images);

        return redirect()->route('admin.contacts.index')->with('success', 'Bulk delete success');
    }
}
