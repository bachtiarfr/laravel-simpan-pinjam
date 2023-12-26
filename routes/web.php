<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('dashboard.admin');
        Route::resource('anggota', 'Admin\AnggotaController');
        Route::get('profile', 'Admin\DashboardController@profile')->name('admin.profile');
        Route::put('update-profile/{user}', 'Admin\DashboardController@update_profile')->name('admin.update-profile');
        Route::get('pengaturan', 'Admin\DashboardController@pengaturan')->name('admin.pengaturan');
        Route::put('update-pengaturan/{user}', 'Admin\DashboardController@update_pengaturan')->name('admin.update-pengaturan');

        Route::resource('pinjaman', 'PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::get('bayar-pinjaman/{id}/{bayarpinjamid}', 'PinjamanController@bayar_pinjaman_detail')->name('pinjaman.bayar.detail');
        Route::put('bayar-pinjaman/{id}/{bayarpinjamid}', 'PinjamanController@bayar_pinjaman_post')->name('pinjaman.bayar.post');
    });

Route::prefix('ketua')
    ->middleware('ketua')
    ->group(function () {
        Route::get('/', 'Ketua\DashboardController@index')->name('dashboard.ketua');
        Route::resource('user', 'Ketua\UserController');
        Route::resource('pengaturan', 'Ketua\PengaturanController');
        Route::get('pinjaman_pdf', 'Ketua\PinjamanController@cetak_pdf')->name('pinjaman.pdf');
        Route::get('pinjaman_excel', 'Ketua\PinjamanController@cetak_excel')->name('pinjaman.excel');
        Route::resource('pinjaman-ketua', 'Ketua\PinjamanController')->except(['create', 'store', 'edit']);
    });
