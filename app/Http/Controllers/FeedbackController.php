<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:feedback create')->only(['create', 'store']);
        $this->middleware('can:feedback read')->only('index');
        $this->middleware('can:feedback update')->only(['edit', 'update']);
        $this->middleware('can:feedback delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::latest()->get();

        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback.create');
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
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'image'],
            'feedback' => ['required', 'string']
        ]);

        $file = $request->file('image');
        $path = Storage::disk('public')->putFile('feedback', new File($file));

        Feedback::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        return view('feedback.edit', compact('feedback'));
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
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'image' => ['file', 'image'],
            'feedback' => ['required', 'string']
        ]);

        $feedback = Feedback::findOrFail($id);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($feedback->image)) {
                Storage::disk('public')->delete($feedback->image);
            }
            $file = $request->file('image');
            $path = Storage::disk('public')->putFile('feedback', new File($file));
        }

        $feedback->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $request->hasFile('image') ? $path : $feedback->image,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        if (Storage::disk('public')->exists($feedback->image)) {
            Storage::disk('public')->delete($feedback->image);
        }

        $feedback->delete();

        return back()->with('success', 'Feedback deleted');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);
        $images = [];

        foreach ($arr as $id) {
            $feedback = Feedback::find($id);
            if ($feedback) {
                array_push($images, $feedback->image);
            }
        }

        Feedback::destroy($arr);
        Storage::disk('public')->delete($images);

        return redirect()->back()->with('success', 'Bulk delete success');
    }
}
