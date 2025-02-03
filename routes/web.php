<?php

use App\Http\Controllers\Admins\AdminAuthController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Backend\Courses\CourseController;
use App\Http\Controllers\Instructors\InstructorAuthController;
use App\Http\Controllers\backend\Instructors\InstructorDashboardController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Setting\AuthenticationController as auth;
use App\Http\Controllers\Backend\Setting\UserController as user;
use App\Http\Controllers\Backend\Setting\DashboardController as dashboard;
use App\Http\Controllers\Backend\Setting\RoleController as role;
use App\Http\Controllers\Backend\Setting\PermissionController as permission;
use App\Http\Controllers\Backend\Students\StudentController as student;
use App\Http\Controllers\Backend\Instructors\InstructorController as instructor;
use App\Http\Controllers\Backend\Courses\CourseCategoryController as courseCategory;
use App\Http\Controllers\Backend\Courses\CourseController as course;
use App\Http\Controllers\Backend\Courses\MaterialController as material;
use App\Http\Controllers\Backend\Quizzes\QuizController as quiz;
use App\Http\Controllers\Backend\Quizzes\QuestionController as question;
use App\Http\Controllers\Backend\Quizzes\OptionController as option;
use App\Http\Controllers\Backend\Quizzes\AnswerController as answer;
use App\Http\Controllers\Backend\Reviews\ReviewController as review;
use App\Http\Controllers\Backend\Communication\DiscussionController as discussion;
use App\Http\Controllers\Backend\Communication\MessageController as message;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchCourseController;
use App\Http\Controllers\CheckoutController as checkout;
use App\Http\Controllers\CouponController as coupon;
use App\Http\Controllers\WatchCourseController as watchCourse;
use App\Http\Controllers\LessonController as lesson;
use App\Http\Controllers\EnrollmentController as enrollment;
use App\Http\Controllers\EventController as event;

/* students */
use App\Http\Controllers\Students\AuthController as sauth;
use App\Http\Controllers\Students\DashboardController as studashboard;
use App\Http\Controllers\Students\ProfileController as stu_profile;
use App\Http\Controllers\Students\sslController as sslcz;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Backend\Instructors\InstructorController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialAuthController;









// frontend pages
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('searchCourse', [SearchCourseController::class, 'index'])->name('searchCourse');

Route::get('courseDetails/{id}', [CourseController::class, 'frontShow'])->name('courseDetails');

Route::get('watchCourse/{id}', [watchCourse::class, 'watchCourse'])->name('watchCourse');
Route::get('instructorProfile/{id}', [instructor::class, 'frontShow'])->name('instructorProfile');
Route::get('checkout', [checkout::class, 'index'])->name('checkout');
Route::post('checkout', [checkout::class, 'store'])->name('checkout.store');








Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback', 'Auth\SocialAuthController@handleGoogleCallback');

Route::get('auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('auth/facebook/callback', 'Auth\SocialAuthController@handleFacebookCallback');




// Enable email verification routes
//Auth::routes(['verify' => true]);

Route::get('/test-email', function () {
    Mail::raw('This is a test email!', function ($message) {
        $message->to('sarrahhbam@gmail.com') // Change to the recipient's email address
        ->subject('Test Email');
    });

    return 'Email sent!';
});

//Email Verification
Route::get('/email/verify/student/{id}', [VerificationController::class, 'verifyStudent'])->name('studentVerification.verify');
Route::get('/email/verify/instructor/{id}', [VerificationController::class, 'verifyInstructor'])->name('instructorVerification.verify');

// Auth Routes
Route::get('/instructor/register', [InstructorAuthController::class, 'signUpForm'])->name('instructorRegister.form');
Route::post('/instructor/register/{back_route}', [InstructorAuthController::class, 'signUpStore'])->name('instructorRegister.store');

// Instructor Login Routes
Route::get('/instructor/login', [InstructorAuthController::class, 'signInForm'])->name('instructorLogin.form');
Route::post('/instructor/login/{back_route}', [InstructorAuthController::class, 'signInCheck'])->name('instructorLogin.store');
Route::post('/instructor-logout', [InstructorAuthController::class, 'signOut'])->name('instructorLogout');
// Instructor Dashboard Route
Route::get('/instructor/dashboard', [InstructorDashboardController::class, 'index'])
    ->name('instructorDashboard')
    ->middleware('checkInstructor');

Route::get('/register', [auth::class, 'signUpForm'])->name('register');
Route::post('/register', [auth::class, 'signUpStore'])->name('register.store');
Route::get('/login', [auth::class, 'signInForm'])->name('login');
Route::post('/login', [auth::class, 'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class, 'signOut'])->name('logOut');


Route::middleware(['checkauth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboard::class, 'index'])->name('dashboard');
    Route::get('userProfile', [auth::class, 'show'])->name('userProfile');
});



// Routes pour l'authentification des administrateurs
Route::prefix('admin')->group(function () {
    // Formulaire d'inscription
    Route::get('/register', [AdminAuthController::class, 'signUpForm'])->name('admin.register.form');

    // Traitement de l'inscription
    Route::post('/register', [AdminAuthController::class, 'signUpStore'])->name('admin.register.store');

    // Formulaire de connexion
    Route::get('/login', [AdminAuthController::class, 'signInForm'])->name('admin.login.form');

    // Traitement de la connexion
    Route::post('/login', [AdminAuthController::class, 'signInCheck'])->name('admin.login.store');

    // Déconnexion
    Route::post('/logout', [AdminAuthController::class, 'signOut'])->name('admin.logout');
});

// Route pour le tableau de bord de l'administrateur




Route::middleware(['checkRole'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', user::class);
    Route::resource('role', role::class);
    Route::resource('student', student::class);
    Route::resource('instructor', instructor::class);
    Route::resource('courseCategory', courseCategory::class);
    Route::resource('course', course::class);
    Route::get('/courseList', [course::class, 'indexForAdmin'])->name('courseList');
    Route::patch('/courseList/{update}', [course::class, 'updateforAdmin'])->name('course.updateforAdmin');
    Route::resource('material', material::class);
    Route::resource('lesson', lesson::class);
    Route::resource('event', event::class);
    Route::resource('quiz', quiz::class);
    Route::resource('question', question::class);
    Route::resource('option', option::class);
    Route::resource('answer', answer::class);
    Route::resource('review', review::class);
    Route::resource('discussion', discussion::class);
    Route::resource('message', message::class);
    Route::resource('coupon', coupon::class);
    Route::resource('enrollment', enrollment::class);
    Route::get('permission/{role}', [permission::class, 'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class, 'save'])->name('permission.save');
});


/* students controllers */
Route::get('/student/register', [sauth::class, 'signUpForm'])->name('studentRegister');
Route::post('/student/register/{back_route}', [sauth::class, 'signUpStore'])->name('studentRegister.store');
Route::get('/student/login', [sauth::class, 'signInForm'])->name('studentLogin');
Route::post('/student/login/{back_route}', [sauth::class, 'signInCheck'])->name('studentLogin.check');
Route::get('/student/logout', [sauth::class, 'signOut'])->name('studentlogOut');

Route::middleware(['checkstudent'])->prefix('students')->group(function () {
    Route::get('/dashboard', [studashboard::class, 'index'])->name('studentdashboard');
    Route::get('/profile', [stu_profile::class, 'index'])->name('student_profile');
    Route::post('/profile/save', [stu_profile::class, 'save_profile'])->name('student_save_profile');
    Route::post('/profile/savePass', [stu_profile::class, 'change_password'])->name('change_password');
    Route::post('/change-image', [stu_profile::class, 'changeImage'])->name('change_image');

    // ssl Routes
    Route::post('/payment/ssl/submit', [sslcz::class, 'store'])->name('payment.ssl.submit');
});



// Cart
Route::get('/cart_page', [CartController::class, 'index']);
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

// Coupon
Route::post('coupon_check', [CartController::class, 'coupon_check'])->name('coupon_check');

/* ssl payment */
Route::post('/payment/ssl/notify', [sslcz::class, 'notify'])->name('payment.ssl.notify');
Route::post('/payment/ssl/cancel', [sslcz::class, 'cancel'])->name('payment.ssl.cancel');




Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');
