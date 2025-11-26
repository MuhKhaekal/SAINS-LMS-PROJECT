<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HalaqahController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Asisten\AnnouncementAsistenController;
use App\Http\Controllers\Asisten\FaqAsistenController;
use App\Http\Controllers\Asisten\HalaqahAsistenController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Asisten\AssignmentController;
use App\Http\Controllers\Asisten\MaterialController;
use App\Models\ClassPai;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    
    Route::middleware('admin')->group(function () {
        Route::post('/daftar-pengguna/importExcel', [UserController::class, 'importExcel'])->name('daftar-pengguna.importExcel');
        Route::delete('daftar-pengguna/destroy-multiple', [UserController::class, 'destroyMultiple'])->name('daftar-pengguna.destroy-multiple');
        Route::resource('daftar-pengguna', UserController::class)
        ->names([
            'index' => 'daftar-pengguna.index',
            'create' => 'daftar-pengguna.create',
            'store' => 'daftar-pengguna.store',
            'show' => 'daftar-pengguna.show',         
            'edit' => 'daftar-pengguna.edit',
            'update' => 'daftar-pengguna.update',
            'destroy' => 'daftar-pengguna.destroy',
        ]);
    
    
        Route::delete('daftar-fakultas/destroy-multiple', [FacultyController::class, 'destroyMultiple'])->name('daftar-fakultas.destroy-multiple');
        Route::resource('daftar-fakultas', FacultyController::class)
        ->names([
            'index' => 'daftar-fakultas.index',
            'create' => 'daftar-fakultas.create',
            'store' => 'daftar-fakultas.store',
            'show' => 'daftar-fakultas.show',         
            'edit' => 'daftar-fakultas.edit',
            'update' => 'daftar-fakultas.update',
            'destroy' => 'daftar-fakultas.destroy',
        ]);
        
        Route::delete('daftar-prodi/destroy-multiple', [ProdiController::class, 'destroyMultiple'])->name('daftar-prodi.destroy-multiple');
        Route::resource('daftar-prodi', ProdiController::class)
        ->names([
            'index' => 'daftar-prodi.index',
            'create' => 'daftar-prodi.create',
            'store' => 'daftar-prodi.store',
            'show' => 'daftar-prodi.show',         
            'edit' => 'daftar-prodi.edit',
            'update' => 'daftar-prodi.update',
            'destroy' => 'daftar-prodi.destroy',
        ]);
    
    
        Route::delete('daftar-kelas/destroy-multiple', [ClassController::class, 'destroyMultiple'])->name('daftar-kelas.destroy-multiple');
        Route::resource('daftar-kelas', ClassController::class)
        ->names([
            'index' => 'daftar-kelas.index',
            'create' => 'daftar-kelas.create',
            'store' => 'daftar-kelas.store',
            'show' => 'daftar-kelas.show',         
            'edit' => 'daftar-kelas.edit',
            'update' => 'daftar-kelas.update',
            'destroy' => 'daftar-kelas.destroy',
        ]);
    
        Route::delete('daftar-halaqah/destroy-multiple', [HalaqahController::class, 'destroyMultiple'])->name('daftar-halaqah.destroy-multiple');
        Route::resource('daftar-halaqah', HalaqahController::class)
        ->names([
            'index' => 'daftar-halaqah.index',
            'create' => 'daftar-halaqah.create',
            'store' => 'daftar-halaqah.store',
            'show' => 'daftar-halaqah.show',         
            'edit' => 'daftar-halaqah.edit',
            'update' => 'daftar-halaqah.update',
            'destroy' => 'daftar-halaqah.destroy',
        ]);
    
        Route::put('faq/add-to-list-faq/{id}', [FaqController::class, 'addToListFaq'])->name('faq.addToListFaq');
        Route::put('faq/delete-from-list-faq/{id}', [FaqController::class, 'deleteFromListFaq'])->name('faq.deleteFromListFaq');
        Route::resource('faq', FaqController::class)
        ->names([
            'index' => 'faq.index',
            'create' => 'faq.create',
            'store' => 'faq.store',
            'show' => 'faq.show',         
            'edit' => 'faq.edit',
            'update' => 'faq.update',
            'destroy' => 'faq.destroy',
        ]);
    
        Route::resource('pengumuman', AnnouncementController::class)
        ->names([
            'index' => 'pengumuman.index',
            'create' => 'pengumuman.create',
            'store' => 'pengumuman.store',
            'show' => 'pengumuman.show',         
            'edit' => 'pengumuman.edit',
            'update' => 'pengumuman.update',
            'destroy' => 'pengumuman.destroy',
        ]);
    
        Route::resource('sertifikat', CertificateController::class)
        ->names([
            'index' => 'sertifikat.index',
            'create' => 'sertifikat.create',
            'store' => 'sertifikat.store',
            'show' => 'sertifikat.show',         
            'edit' => 'sertifikat.edit',
            'update' => 'sertifikat.update',
            'destroy' => 'sertifikat.destroy',
        ]);
    
        Route::resource('laporan', ReportController::class)
        ->names([
            'index' => 'laporan.index',
            'create' => 'laporan.create',
            'store' => 'laporan.store',
            'show' => 'laporan.show',         
            'edit' => 'laporan.edit',
            'update' => 'laporan.update',
            'destroy' => 'laporan.destroy',
        ]);
    
        Route::resource('pertemuan', MeetingController::class)
        ->names([
            'index' => 'pertemuan.index',
            'create' => 'pertemuan.create',
            'store' => 'pertemuan.store',
            'show' => 'pertemuan.show',         
            'edit' => 'pertemuan.edit',
            'update' => 'pertemuan.update',
            'destroy' => 'pertemuan.destroy',
        ]);
    });

    Route::middleware('asisten')->group(function () {
        Route::resource('halaqah-asisten', HalaqahAsistenController::class)
        ->names([
            'index' => 'halaqah-asisten.index',
            'create' => 'halaqah-asisten.create',
            'store' => 'halaqah-asisten.store',
            'show' => 'halaqah-asisten.show',         
            'edit' => 'halaqah-asisten.edit',
            'update' => 'halaqah-asisten.update',
            'destroy' => 'halaqah-asisten.destroy',
        ]);

        Route::resource('pengumuman-asisten', AnnouncementAsistenController::class)
        ->names([
            'index' => 'pengumuman-asisten.index',
            'create' => 'pengumuman-asisten.create',
            'store' => 'pengumuman-asisten.store',
            'show' => 'pengumuman-asisten.show',         
            'edit' => 'pengumuman-asisten.edit',
            'update' => 'pengumuman-asisten.update',
            'destroy' => 'pengumuman-asisten.destroy',
        ]);

        Route::put('faq/add-to-list-faq-asisten/{id}', [FaqAsistenController::class, 'addToListFaq'])->name('faq.addToListFaqAsisten');
        Route::put('faq/delete-from-list-faq-asisten/{id}', [FaqAsistenController::class, 'deleteFromListFaq'])->name('faq.deleteFromListFaqAsisten');
        Route::resource('faq-asisten', FaqAsistenController::class)
        ->names([
            'index' => 'faq-asisten.index',
            'create' => 'faq-asisten.create',
            'store' => 'faq-asisten.store',
            'show' => 'faq-asisten.show',         
            'edit' => 'faq-asisten.edit',
            'update' => 'faq-asisten.update',
            'destroy' => 'faq-asisten.destroy',
        ]);


        Route::resource('materi-asisten', MaterialController::class)
            ->names([
                'index' => 'materi-asisten.index',
                'create' => 'materi-asisten.create',
                'store' => 'materi-asisten.store',
                'show' => 'materi-asisten.show',         
                'edit' => 'materi-asisten.edit',
                'update' => 'materi-asisten.update',
                'destroy' => 'materi-asisten.destroy',
        ]);
        
        Route::resource('tugas-asisten', AssignmentController::class)
            ->names([
                'index' => 'tugas-asisten.index',
                'create' => 'tugas-asisten.create',
                'store' => 'tugas-asisten.store',
                'show' => 'tugas-asisten.show',         
                'edit' => 'tugas-asisten.edit',
                'update' => 'tugas-asisten.update',
                'destroy' => 'tugas-asisten.destroy',
        ]);
    });




});
