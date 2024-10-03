<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TherapistApprovalController;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TherapistRegisterController;
use App\Http\Controllers\UserCodeController;
use App\Http\Controllers\DASSController;
use App\Http\Controllers\TherapistProfileController;




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




Route::middleware(['2fa','auth'])->group(function (){
	Route::post('/2fa', function () {
		// Get the authenticated user
		$user = auth()->user();
	
		// Check the user's role and redirect accordingly
		if ($user->role->name == 'doctor' || $user->role->name == 'admin') {
			return redirect('/dashboard');
		} elseif ($user->role->name == 'patient') {
			return redirect('/home');
		}
	})->name('2fa')->middleware('2fa');
	
	Route::get('/dashboard','DashboardController@index');
	Route::get('/home', 'HomeController@index')->name('home');	
	
});

// Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('2fa');

// Route::get('register_therapist', [App\Http\Controllers\Auth\TherapistRegisterController::class, 'showTherapistRegistrationForm'])->name('register.therapist');
// Route::post('register/therapist', [App\Http\Controllers\Auth\TherapistRegisterController::class, 'registerTherapist']);
// Route::post('complete-therapist-registration', [App\Http\Controllers\Auth\TherapistRegisterController::class, 'completeTherapistRegistration'])->name('complete.therapist.registration');


// Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
// Route::get('/complete-registration',  [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])->name('complete.registration');


Route::get('register_therapist', [TherapistRegisterController::class, 'showTherapistRegistrationForm'])->name('register.therapist');
Route::post('register_therapist', [TherapistRegisterController::class, 'registerTherapist']);
Route::post('complete-therapist-registration', [TherapistRegisterController::class, 'completeTherapistRegistration'])->name('complete.therapist.registration');

Route::get('google2fa/register', [TherapistRegisterController::class, 'show2FASetup'])->name('google2fa.register');


Route::get('/complete-registration',  [RegisterController::class, 'completeRegistration'])->name('complete.registration');
Route::get('/approval-required', function () {
    return view('auth.approval_required');
})->name('approval_required');

// web.php or routes.php

Route::view('/approval-required', 'auth.approval_required')->name('auth.approval_required');

Auth::routes();
Route::get('/event','EventCalender@index');
Route::get('/','FrontendController@index');
Route::get('/new-appointment/{doctorId}/{date}','FrontendController@show')->name('create.appointment');
// Route::get('/google2fa/setup', 'Auth\Google2FASetupController@showSetupForm')->name('google2fa.setup');
// Route::post('/google2fa/complete', 'Auth\Google2FASetupController@completeSetup')->name('google2fa.complete');

Route::group(['middleware'=>['auth','patient']],function(){
	Route::post('/book/appointment','FrontendController@store')->name('booking.appointment');
	Route::get('/my-booking','FrontendController@myBookings')->name('my.booking');

	Route::get('/user-profile','ProfileController@index');
	Route::post('/user-profile','ProfileController@store')->name('profile.store');
	Route::post('/profile-pic','ProfileController@profilePic')->name('profile.pic');

	Route::get('/my-prescription','FrontendController@myPrescription')->name('my.prescription');
	Route::post('/submit', 'DASSController@submit')->name('dass.submit');
	Route::get('/take-test', [DASSController::class, 'showTestForm'])->name('take.test');
	Route::get('/dass', [DASSController::class, 'index'])->name('dass.index');
	Route::get('/dass/results', [DASSController::class, 'results'])->name('dass.results');
});

Route::group(['middleware'=>['auth','admin']],function(){
	Route::resource('doctor','DoctorController');
	Route::get('/patients','PatientlistController@index')->name('patient');
	Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
	Route::get('/status/update/{id}','PatientlistController@toggleStatus')->name('update.status');
	Route::resource('department','DepartmentController');
	Route::resource('user_list','UserListController');
	Route::resource('department','DepartmentController');
	Route::resource('audit_trail','AuditController');

	Route::get('therapists', [TherapistApprovalController::class, 'index'])->name('therapists.index');
    Route::post('therapists/{id}/approve', [TherapistApprovalController::class, 'approve'])->name('therapists.approve');
    Route::post('therapists/{id}/reject', [TherapistApprovalController::class, 'reject'])->name('therapists.reject');
	Route::get('/admin/therapists/{id}/certification', 'TherapistApprovalController@viewCertification')->name('therapists.viewCertification');

});

Route::group(['middleware'=>['auth','doctor','approved.therapist']],function(){
	Route::resource('appointment','AppointmentController');
	Route::post('/appointment/check','AppointmentController@check')->name('appointment.check');
	Route::post('/appointment/update','AppointmentController@updateTime')->name('update');
	Route::get('patient-today','PrescriptionController@index')->name('patients.today');
	Route::post('/prescription','PrescriptionController@store')->name('prescription');
	Route::get('/prescription/{userId}/{date}','PrescriptionController@show')->name('prescription.show');
	Route::get('/prescribed-patients','PrescriptionController@patientsFromPrescription')->name('prescribed.patients');
	Route::get('/prescription/{encryptedId}/{encryptedDate}/file', 'PrescriptionController@viewFile')->name('prescription.file');

	

	Route::get('therapist/profile', [TherapistProfileController::class, 'index'])->name('therapist.profile.index');
	Route::post('therapist/profile/store', [TherapistProfileController::class, 'store'])->name('therapist.profile.store');
	Route::post('therapist/profile/pic', [TherapistProfileController::class, 'profilePic'])->name('therapist.profile.pic');

	Route::resource('doctor','DoctorController');
	Route::get('/patients','PatientlistController@index')->name('patient');
	Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
	Route::get('/status/update/{id}','PatientlistController@toggleStatus')->name('update.status');
});

// Route::post('/api/doctors','FrontendController@getDoctors');
// Route::get('/api/doctors/today','FrontendController@doctorToday');



