<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminIndex;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FooterLogoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhyusController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\UserController;
use App\Mail\ContactUs;
use App\Models\About;
use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Feedback;
use App\Models\Service;
use App\Models\Whyus;
use App\Models\Contact;
use App\Models\Standard;
use App\Models\FooterLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $feedbacks = Feedback::latest()->get();
    $blogs = Blog::latest()->limit(10)->get();
    $services = Service::latest()->get();
    $abouts = About::latest()->get();
    $whyus = Whyus::all();
    $footerlogos = FooterLogo::all();
    $about = Service::latest()->get();
    $standardsRaw = Standard::latest()->simplePaginate(10);
    $standardsArr = [];
    $email = Contact::where('url_slug', 'office-email')->get();
    $address = Contact::where('url_slug', 'address')->get();
    $phonenumber = Contact::where('url_slug', 'phone-number')->get();

    foreach ($standardsRaw as $item) {
        $dom = new DOMDocument();
        @$dom->loadHTML($item->content, LIBXML_HTML_NODEFDTD);

        $text = $dom->textContent;
        array_push($standardsArr, [
            'id' => $item->id,
            'name' => $item->name,
            'title' => $item->title,
            'content' => $text,
            'image' => $item->image,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ]);
    }

    $standards = json_decode(json_encode($standardsArr));

    $clients = Client::latest()->get();

    return view('landingpage', compact('standards', 'clients', 'standardsRaw', 'blogs', 'services', 'whyus', 'feedbacks', 'about','footerlogos','email','address','phonenumber'));
})->name('landingpage');

Route::get('/trainings', [StandardController::class, 'indexPublic'])->name('trainings.show');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/abouts/{id}', [AboutController::class, 'show'])->name('abouts.show');
Route::get('/blogs', [BlogController::class, 'indexPublic'])->name('blogs.indexPublic');
Route::get('/blogs/{id}', [BlogController::class, 'showPublic'])->name('blogs.showPublic');

Route::get('/about-us', function () {
    $about = About::first();
    $blogs = Blog::latest()->limit(10)->get();

    return view('about', compact('about', 'blogs'));
})->name('about.index');

Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified', 'can:admin access'])->prefix('admklask')->name('admin.')->group(function () {
    Route::get('/', AdminIndex::class)->name('index');

    // roles & permissions
    Route::resource('/permissions', PermissionController::class)->except(['show']);
    Route::resource('/roles', RoleController::class)->except(['show']);

    // users
    Route::resource('/users', UserController::class);

    // certificates
    Route::resource('/certificates', CertificateController::class);

    // trainings
    Route::post('trainings-2', [StandardController::class, 'updateTraining'])->name('trainings.update.2');
    Route::resource('/trainings', StandardController::class)->names('trainings')->except('show');

    // services
    Route::resource('/services', ServiceController::class)->names('services')->except('show');

    
    // services
    Route::resource('/abouts', AboutController::class)->names('abouts')->except('show');

    // Whyus
    Route::resource('/why', WhyusController::class)->names('whyus')->except('show');

    // clients
    Route::resource('/clients', ClientController::class)->except(['show']);

    // contacts
    Route::resource('/contacts', ContactController::class)->except(['show']);

    //footer logos
    Route::resource('/footerlogos', FooterLogoController::class)->except(['show']);

    // feedback
    Route::resource('/feedback', FeedbackController::class)->except(['show']);

    // about
    // Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    // Route::post('/about', [AboutController::class, 'update'])->name('about.update');

    // application form
    // Route::any('/application-form', ApplicationFormController::class)->name('application.form.any');

    // blogs | comment this route below to disable Blog features
    Route::resource('/blogs', BlogController::class);

    // bulk delete
    Route::delete('/bulk-delete/permissions', [PermissionController::class, 'massDelete'])->name('permissions.bulkDelete');
    Route::delete('/bulk-delete/roles', [RoleController::class, 'massDelete'])->name('roles.bulkDelete');
    Route::delete('/bulk-delete/users', [UserController::class, 'massDelete'])->name('users.bulkDelete');
    Route::delete('/bulk-delete/standards', [StandardController::class, 'massDelete'])->name('trainings.bulkDelete');
    Route::delete('/bulk-delete/services', [ServiceController::class, 'massDelete'])->name('services.bulkDelete');
    Route::delete('/bulk-delete/abouts', [AboutController::class, 'massDelete'])->name('abouts.bulkDelete');
    Route::delete('/bulk-delete/certificates', [CertificateController::class, 'massDelete'])->name('certificates.bulkDelete');
    Route::delete('/bulk-delete/clients', [ClientController::class, 'massDelete'])->name('clients.bulkDelete');
    Route::delete('/bulk-delete/blogs', [BlogController::class, 'massDelete'])->name('blogs.bulkDelete');
    Route::delete('/bulk-delete/feedback', [FeedbackController::class, 'massDelete'])->name('feedback.bulkDelete');
    Route::delete('/bulk-delete/whyus', [WhyusController::class, 'massDelete'])->name('whyus.bulkDelete');
    Route::delete('/bulk-delete/contacts', [ContactController::class, 'massDelete'])->name('contacts.bulkDelete');
    Route::delete('/bulk-delete/footerlogos', [FooterLogoController::class, 'massDelete'])->name('footerlogos.bulkDelete');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('account/verify-new-email/{token}', [AccountController::class, 'verifyNewEmail'])->name('account.verifyNewEmail');
    Route::resource('account', AccountController::class)->only(['index', 'edit', 'update']);
});

// sample captcha : start
// Route::view('/test', 'test');

// Route::view('/check-certificates', 'check-certificate')->name('check.certificate');
Route::get('/check-certificates', function () {
    $title = "Cek Sertifikat";
    $footerlogos = FooterLogo::all();
    return view('check-certificate', compact('title','footerlogos'));
})->name('check.certificate');
Route::post('/check-certificates', function () {
    $request = request();
    $request->validate([
        'captcha' => ['required', 'captcha'],
        'company_name' => ['required', 'string'],
        'no' => ['required', 'string']
    ], [
        'captcha.captcha' => 'Captcha does not match'
    ]);

    $certificate = Certificate::where(['company_name' => $request->company_name, 'no' => $request->no])->first();
    
    if (!$certificate) {
        return back()->with('error', 'Certificate not found');
    }

    return redirect()->route('certificates.show', $certificate->no);
})->name('check.certificate.process');

Route::get('/certificates/{certificate}', function ($certificate) {
    $certificate = Certificate::where(['no' => $certificate])->first();
    $footerlogos = FooterLogo::all();
    if (!$certificate) {
        return redirect()->route('check.certificate')->with('error', 'Certificate not found');
    }

    return view('certificate-result', compact('certificate','footerlogos'));
})->where('certificate', '(.*)')->name('certificates.show');

Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_img('math')]);
});

Route::post('/send-email', function () {
    $request = request();

    $request->validate([
        'company_name' => ['required', 'string'],
        'name' => ['required', 'string'],
        'location' => ['required', 'string'],
        'phone' => ['required', 'string'],
        'message' => ['required', 'string']
    ]);

    Mail::to('office@ssabaccreditation.com')->send(new ContactUs($request));

    if ($request->notCheck) {
        $landingPage = route('landingpage') . '#section-contact-us';

        return redirect($landingPage)->with('sent', 'Email sent!');
    }

    return redirect()->route('check.certificate')->with('success', 'Email sent');
})->name('contactus.email');

require __DIR__ . '/auth.php';
