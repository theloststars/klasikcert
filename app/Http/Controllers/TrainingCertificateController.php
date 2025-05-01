<?php

namespace App\Http\Controllers;

use App\Models\TrainingCertificate;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrainingCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:certificates create')->only(['create', 'store']);
        $this->middleware('can:certificates read')->only(['index']);
        $this->middleware('can:certificates update')->only(['edit', 'update']);
        $this->middleware('can:certificates delete')->only(['destroy', 'massDelete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainingcertificates = TrainingCertificate::latest()->get();

        return view('admin.trainingcertificates.index', compact('trainingcertificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standards = Standard::orderBy('name', 'asc')->get();

        return view('admin.trainingcertificates.create', compact('standards'));
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
            // 'standard' => ['required', 'exists:standards,id'],
            'no_sertifikat' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required', 'string'],
            'training' => ['required', 'string']
        ]);

        TrainingCertificate::create([
            'no_sertifikat' => $request->no_sertifikat,
            'name' => $request->name,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'training' => $request->training
        ]);

        return redirect()->route('admin.trainingcertificates.index')->with('success', 'Certificate created');
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
        $trainingcertificate = TrainingCertificate::findOrFail($id);
        $standards = Standard::orderBy('name', 'asc')->get();

        return view('admin.trainingcertificates.edit', compact('trainingcertificate', 'standards'));
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
            // 'standard' => ['required', 'exists:standards,id'],
            'no_sertifikat' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'training' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required', 'string', 'max:255']
        ]);

        $trainingcertificate = TrainingCertificate::findOrFail($id);
        $trainingcertificate->update([
            'no_sertifikat' => $request->no_sertifikat,
            'name' => $request->name,
            'training' => $request->training,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status
        ]);

        return redirect()->route('admin.trainingcertificates.index')->with('success', 'Certificate updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TrainingCertificate::destroy($id);
        return redirect()->route('admin.trainingcertificates.index')->with('success', 'Certificate deleted');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $id) {
            TrainingCertificate::destroy($id);
        }

        return redirect()->route('admin.trainingcertificates.index')->with('success', 'Bulk delete success');
    }
}
