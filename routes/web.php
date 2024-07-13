<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AdminDashboardController@index')->name('dashboard.admin');
        Route::resource('user', 'Dashboard\UserController');
        // Route::get('kelompok', 'Dashboard\KelompokController@index')->name('admin.kelompok.index');
        Route::resource('kelompok', 'Dashboard\KelompokController');
        Route::get('profile', 'Dashboard\Controller@profile')->name('admin.profile');
        Route::put('update-profile/{user}', 'Dashboard\Controller@update_profile')->name('admin.update-profile');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('pinjaman', 'Dashboard\PinjamanController@index')->name('admin.show.pinjaman');
        Route::post('pinjaman/create', 'Dashboard\PinjamanController@create')->name('admin.create.pinjaman');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::get('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_detail')->name('pinjaman.bayar.detail');
        Route::put('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_post')->name('pinjaman.bayar.post');
    });

Route::prefix('direktur')
    ->middleware('direktur')
    ->group(function () {
        Route::get('/', 'Dashboard\DirekturDashboardController@index')->name('dashboard.direktur');
        Route::get('kelompok', 'Dashboard\KelompokController@index')->name('kelompok.index');
        Route::get('approval/{kelompok_id}', 'Dashboard\KelompokController@approvalByID')->name('kelompok.approval');
        Route::get('pengaturan', 'Dashboard\PengaturanController@show')->name('pengaturan.show');
        Route::put('pengaturan/edit/{id}', 'Dashboard\PengaturanController@update')->name('pengaturan.update');
        Route::get('pinjaman_pdf', 'Dashboard\PinjamanController@cetak_pdf')->name('pinjaman.pdf');
        Route::get('pinjaman_excel', 'Dashboard\PinjamanController@cetak_excel')->name('pinjaman.excel');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
        Route::post('approval/pengajuan/kelompok', 'Dashboard\PengajuanKelompokController@approvalPage')->name('approval.pengajuan.kelompok');
        // Route::post('reject/kelompok/{dokumen_id}', 'Dashboard\KelompokController@rejectKelompok')->name('reject.pengajuan');
    });

Route::prefix('kelompok')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AnggotaKelompokDashboardController@index')->name('dashboard.anggota_kelompok');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
    });
