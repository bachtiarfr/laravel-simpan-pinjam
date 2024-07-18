<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('pegawai')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\PegawaiDashboardController@index')->name('dashboard.pegawai');
        Route::resource('user', 'Dashboard\UserController');
        Route::get('direktur', 'Dashboard\UserController@showDirektur')->name('show.direktur.index');
        Route::get('pegawai', 'Dashboard\UserController@showPegawai')->name('show.pegawai.index');

        Route::get('direktur/tambah', 'Dashboard\UserController@addDirektur')->name('direktur.create');
        Route::get('pegawai/tambah', 'Dashboard\UserController@addPegawai')->name('pegawai.create');

        Route::delete('direktur/hapus', 'Dashboard\UserController@direkturDelete')->name('direktur.delete');
        Route::delete('pegawai/hapus', 'Dashboard\UserController@pegawaiDelete')->name('pegawai.delete');

        Route::post('pegawai/save', 'Dashboard\UserController@storePegawai')->name('pegawai.store');
        Route::post('direktur/save', 'Dashboard\UserController@storeDirektur')->name('direktur.store');

        Route::resource('kelompok', 'Dashboard\KelompokController');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('pinjaman', 'Dashboard\PinjamanController@index')->name('pegawai.show.pinjaman');
        Route::post('pinjaman/create', 'Dashboard\PinjamanController@create')->name('pegawai.create.pinjaman');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::get('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_detail')->name('pinjaman.bayar.detail');
        Route::put('bayar-pinjaman/{id}/{bayarpinjamid}', 'Dashboard\PinjamanController@bayar_pinjaman_post')->name('pinjaman.bayar.post');
    });

Route::prefix('direktur')
    ->middleware('direktur')
    ->group(function () {
        Route::get('/', 'Dashboard\DirekturDashboardController@index')->name('dashboard.direktur');
        Route::get('kelompok', 'Dashboard\KelompokController@index')->name('direktur.kelompok.index');
        Route::get('pinjaman_pdf', 'Dashboard\PinjamanController@cetak_pdf')->name('pinjaman.pdf');
        Route::get('pinjaman_excel', 'Dashboard\PinjamanController@cetak_excel')->name('pinjaman.excel');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
        Route::post('approval/pengajuan/kelompok', 'Dashboard\PengajuanKelompokController@approval')->name('approval.pengajuan.kelompok');
    });

Route::prefix('kelompok')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AnggotaKelompokDashboardController@index')->name('dashboard.anggota_kelompok');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
    });
