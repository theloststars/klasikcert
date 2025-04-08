<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:application form access');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $method = $request->method();

        switch ($method) {
            case 'GET':
                return $this->processGet($request);
                break;

            case 'POST':
                $request->validate([
                    'file' => ['required', 'file']
                ]);

                return $this->processPost($request);
                break;

            default:
                return abort(404);
                break;
        }
    }

    private function processGet($request)
    {
        $form = ApplicationForm::first();

        if (!$form) {
            ApplicationForm::create([
                'file_name' => 'file name',
                'file' => 'file.pdf'
            ]);
        }

        return view('application_form.index');
    }

    private function processPost($request)
    {
        $form = ApplicationForm::first();

        if (!$form) {
            return redirect()->route('admin.application.form.any');
        }

        if (Storage::disk('public')->exists($form->file)) {
            Storage::disk('public')->delete($form->file);
        }

        $file = $request->file('file');
        $original_file_name =  $file->getClientOriginalName();
        $path = Storage::disk('public')->putFileAs('application_form', new File($file), $original_file_name);

        $form->update([
            'file_name' => 'application form',
            'file' => $path
        ]);

        return back()->with('success', 'File uploaded');
    }
}
