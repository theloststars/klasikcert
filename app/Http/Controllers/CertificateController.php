<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\FooterLogo;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CertificateController extends Controller
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
        $certificates = Certificate::latest()->get();

        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standards = Standard::orderBy('name', 'asc')->get();

        return view('admin.certificates.create', compact('standards'));
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
            'no' => ['required', 'string', 'unique:certificates,no', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            // 'scope' => ['required', 'string'],
            'issue_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
            // 'certification_body' => ['required', 'string'],
            // 'status' => ['required', 'string'],
            'training' => ['required', 'string']
        ]);

        Certificate::create([
            'no' => $request->no,
            'company_name' => $request->company_name,
            'location' => $request->location,
            // 'standard_id' => $request->standard,
            // 'scope' => $request->scope,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            // 'certification_body' => $request->certification_body,
            // 'status' => $request->status,
            'training' => $request->training
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created');
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
        $certificate = Certificate::findOrFail($id);
        $standards = Standard::orderBy('name', 'asc')->get();

        return view('admin.certificates.edit', compact('certificate', 'standards'));
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
            'no' => ['required', 'string', 'max:255', Rule::unique('certificates', 'no')->ignore($id)],
            'company_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            // 'certification_body' => ['required', 'string'],
            // 'scope' => ['required', 'string'],
            'issue_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
            // 'status' => ['required', 'string', 'max:255'],
            'training' => ['required', 'string']
        ]);

        $certificate = Certificate::findOrFail($id);
        $certificate->update([
            'no' => $request->no,
            'company_name' => $request->company_name,
            'location' => $request->location,
            // 'standard_id' => $request->standard,
            // 'scope' => $request->scope,
            // 'certification_body' => $request->certification_body,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            // 'status' => $request->status,
            'training' => $request->training
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Certificate::destroy($id);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $id) {
            Certificate::destroy($id);
        }

        return redirect()->route('admin.certificates.index')->with('success', 'Bulk delete success');
    }
}
