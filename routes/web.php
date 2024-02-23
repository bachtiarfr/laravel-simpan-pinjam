<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AdminDashboardController@index')->name('dashboard.admin');
        Route::resource('kelompok', 'Dashboard\KelompokController');
        Route::get('profile', 'Dashboard\Controller@profile')->name('admin.profile');
        Route::put('update-profile/{user}', 'Dashboard\Controller@update_profile')->name('admin.update-profile');
        // Route::get('pengaturan', 'Admin\DashboardController@pengaturan')->name('admin.pengaturan');
        // Route::put('update-pengaturan/{user}', 'Admin\DashboardController@update_pengaturan')->name('admin.update-pengaturan');

        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::get('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_detail')->name('pinjaman.bayar.detail');
        Route::put('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_post')->name('pinjaman.bayar.post');
    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/', 'Dashboard\KetuaDashboardController@index')->name('dashboard.ketua');
        Route::resource('user', 'Dashboard\UserController');
        Route::resource('pengaturan', 'Dashboard\PengaturanController');
        Route::get('pinjaman_pdf', 'Dashboard\PinjamanController@cetak_pdf')->name('pinjaman.pdf');
        Route::get('pinjaman_excel', 'Dashboard\PinjamanController@cetak_excel')->name('pinjaman.excel');
        Route::resource('pinjaman-ketua', 'Dashboard\PinjamanController')->except(['create', 'store', 'edit']);
    });

Route::prefix('anggota')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AnggotaDashboardController@index')->name('dashboard.anggota');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
    });
