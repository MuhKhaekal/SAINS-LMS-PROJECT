<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CreatePreTestController;
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
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Asisten\AsistenCertificateController;
use App\Http\Controllers\Asisten\AsistenTestController;
use App\Http\Controllers\Asisten\AssignmentController;
use App\Http\Controllers\Asisten\MaterialController;
use App\Http\Controllers\Asisten\PosttestController;
use App\Http\Controllers\Asisten\PresenceController;
use App\Http\Controllers\Asisten\PretestController;
use App\Http\Controllers\Asisten\SubmissionAsistenController;
use App\Http\Controllers\Asisten\WeeklyScoreController;
use App\Http\Controllers\Praktikan\AnnouncementPraktikanController;
use App\Http\Controllers\Praktikan\AnswerPreTestController;
use App\Http\Controllers\Praktikan\AssignmentPraktikanController;
use App\Http\Controllers\Praktikan\FaqPraktikanController;
use App\Http\Controllers\Praktikan\HalaqahPraktikanController;
use App\Http\Controllers\Praktikan\MaterialPraktikanController;
use App\Http\Controllers\Praktikan\PraktikanCertificateController;
use App\Http\Controllers\Praktikan\PraktikanTestController;
use App\Http\Controllers\Praktikan\SubmissionPraktikanController;
use App\Models\ClassPai;
use App\Models\Presence;
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

    
        Route::middleware('asisten')->group(function () {
            Route::get('/sertifikat/validasi', [AsistenCertificateController::class, 'indexValidasi'])->name('asisten.sertifikat.validasi');
            Route::post('/sertifikat/sahkan/{userId}', [AsistenCertificateController::class, 'storeSahkan'])->name('asisten.sertifikat.store');
            Route::get('/sertifikat/download/{type}', [AsistenCertificateController::class, 'download'])->name('sertifikat.download');
            Route::delete('/sertifikat/batalkan/{userId}', [AsistenCertificateController::class, 'revokeSahkan'])->name('asisten.sertifikat.revoke');
    
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
    
            Route::resource('presensi-asisten', PresenceController::class)
                ->names([
                    'index' => 'presensi-asisten.index',
                    'create' => 'presensi-asisten.create',
                    'store' => 'presensi-asisten.store',
                    'show' => 'presensi-asisten.show',         
                    'edit' => 'presensi-asisten.edit',
                    'update' => 'presensi-asisten.update',
                    'destroy' => 'presensi-asisten.destroy',
            ]);
    
            Route::post('/periksa-tugas/update', [SubmissionAsistenController::class, 'updateAll'])
            ->name('periksa-tugas.update');
    
            Route::get('/ujian', [AsistenTestController::class, 'indexPretest'])->name('ujian-asisten.index');
    
            Route::post('/ujian/buka/{id}', [AsistenTestController::class, 'open'])->name('ujian-asisten.open');
    
            Route::post('/ujian/tutup/{id}', [AsistenTestController::class, 'close'])->name('ujian-asisten.close');
    
            Route::resource('nilai-perpekan', WeeklyScoreController::class)
                ->names([
                    'index' => 'nilai-perpekan.index',
                    'create' => 'nilai-perpekan.create',
                    'store' => 'nilai-perpekan.store',
                    'show' => 'nilai-perpekan.show',         
                    'edit' => 'nilai-perpekan.edit',
                    'update' => 'nilai-perpekan.update',
                    'destroy' => 'nilai-perpekan.destroy',
            ]);
    
            Route::resource('pretest', PretestController::class)
            ->names([
                'index' => 'pretest.index',
                'create' => 'pretest.create',
                'store' => 'pretest.store',
                'show' => 'pretest.show',         
                'edit' => 'pretest.edit',
                'update' => 'pretest.update',
                'destroy' => 'pretest.destroy',
            ]);
    
            Route::resource('posttest', PosttestController::class)
            ->names([
                'index' => 'posttest.index',
                'create' => 'posttest.create',
                'store' => 'posttest.store',
                'show' => 'posttest.show',         
                'edit' => 'posttest.edit',
                'update' => 'posttest.update',
                'destroy' => 'posttest.destroy',
            ]);
    
    
        });
        
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
    
        Route::post('/sertifikat/assign', [CertificateController::class, 'assign'])->name('sertifikat.assign');
        Route::delete('/sertifikat/{certId}/revoke/{userId}', [CertificateController::class, 'revoke'])->name('sertifikat.revoke');
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

        Route::get('/buat-test/review/pretest', [TestController::class, 'reviewPretest'])->name('questions.review-pretest');
        Route::resource('buat-test', TestController::class)
        ->names([
            'index' => 'buat-test.index',
            'create' => 'buat-test.create',
            'store' => 'buat-test.store',
            'show' => 'buat-test.show',         
            'edit' => 'buat-test.edit',
            'update' => 'buat-test.update',
            'destroy' => 'buat-test.destroy',
        ]);
    });



    Route::middleware('praktikan')->group(function () {

        Route::get('/sertifikat/download/{type}', [PraktikanCertificateController::class, 'download'])->name('sertifikat-praktikan.download');

        Route::resource('halaqah-praktikan', HalaqahPraktikanController::class)
        ->names([
            'index' => 'halaqah-praktikan.index',
            'create' => 'halaqah-praktikan.create',
            'store' => 'halaqah-praktikan.store',
            'show' => 'halaqah-praktikan.show',         
            'edit' => 'halaqah-praktikan.edit',
            'update' => 'halaqah-praktikan.update',
            'destroy' => 'halaqah-praktikan.destroy',
        ]);

        Route::resource('pengumuman-praktikan', AnnouncementPraktikanController::class)
        ->names([
            'index' => 'pengumuman-praktikan.index',
            'create' => 'pengumuman-praktikan.create',
            'store' => 'pengumuman-praktikan.store',
            'show' => 'pengumuman-praktikan.show',         
            'edit' => 'pengumuman-praktikan.edit',
            'update' => 'pengumuman-praktikan.update',
            'destroy' => 'pengumuman-praktikan.destroy',
        ]);

        Route::resource('faq-praktikan', FaqPraktikanController::class)
        ->names([
            'index' => 'faq-praktikan.index',
            'create' => 'faq-praktikan.create',
            'store' => 'faq-praktikan.store',
            'show' => 'faq-praktikan.show',         
            'edit' => 'faq-praktikan.edit',
            'update' => 'faq-praktikan.update',
            'destroy' => 'faq-praktikan.destroy',
        ]);


        Route::resource('materi-praktikan', MaterialPraktikanController::class)
            ->names([
                'index' => 'materi-praktikan.index',
                'create' => 'materi-praktikan.create',
                'store' => 'materi-praktikan.store',
                'show' => 'materi-praktikan.show',         
                'edit' => 'materi-praktikan.edit',
                'update' => 'materi-praktikan.update',
                'destroy' => 'materi-praktikan.destroy',
        ]);
        
        Route::resource('tugas-praktikan', AssignmentPraktikanController::class)
            ->names([
                'index' => 'tugas-praktikan.index',
                'create' => 'tugas-praktikan.create',
                'store' => 'tugas-praktikan.store',
                'show' => 'tugas-praktikan.show',         
                'edit' => 'tugas-praktikan.edit',
                'update' => 'tugas-praktikan.update',
                'destroy' => 'tugas-praktikan.destroy',
        ]);

        Route::resource('pengajuan-tugas', SubmissionPraktikanController::class)
            ->names([
                'index' => 'pengajuan-tugas.index',
                'create' => 'pengajuan-tugas.create',
                'store' => 'pengajuan-tugas.store',
                'show' => 'pengajuan-tugas.show',         
                'edit' => 'pengajuan-tugas.edit',
                'update' => 'pengajuan-tugas.update',
                'destroy' => 'pengajuan-tugas.destroy',
        ]);
        
        Route::get('/ujian-praktikan', [PraktikanTestController::class, 'index'])->name('ujian-praktikan.index');
        Route::post('/ujian-praktikan/mulai/{id}', [PraktikanTestController::class, 'start'])->name('ujian-praktikan.start');

        Route::get('/ujian-praktikan/{submissionId}/jawab', [PraktikanTestController::class, 'take'])->name('ujian-praktikan.take');

        Route::post('/ujian-praktikan/{testId}/kumpul', [PraktikanTestController::class, 'submit'])->name('ujian-praktikan.submit');
    });



});
