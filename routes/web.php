<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', 'Auth\LoginController@index');
Auth::routes(['register' => false]);

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\PegawaiDashboardController@index')->name('dashboard.pegawai');
        
        Route::get('user/list', 'Dashboard\UserController@showUser')->name('show.user');
        Route::get('pegawai/list', 'Dashboard\UserController@showPegawai')->name('show.pegawai');
        Route::get('direktur/list', 'Dashboard\UserController@showDirektur')->name('show.direktur');
        
        Route::get('user/detail/{id}', 'Dashboard\UserController@detail')->name('user.detail');

        Route::get('user/tambah', 'Dashboard\UserController@create')->name('user.create');
        Route::get('direktur/tambah', 'Dashboard\UserController@addDirektur')->name('direktur.create');
        Route::get('pegawai/tambah', 'Dashboard\UserController@addPegawai')->name('pegawai.create');

        Route::delete('user/hapus/{id}', 'Dashboard\UserController@userDelete')->name('user.delete');
        Route::delete('direktur/hapus/{id}', 'Dashboard\UserController@direkturDelete')->name('direktur.delete');
        Route::delete('pegawai/hapus/{id}', 'Dashboard\UserController@pegawaiDelete')->name('pegawai.delete');

        Route::post('user/simpan', 'Dashboard\UserController@store')->name('user.store');
        Route::post('pegawai/simpan', 'Dashboard\UserController@storePegawai')->name('pegawai.store');
        Route::post('direktur/simpan', 'Dashboard\UserController@storeDirektur')->name('direktur.store');

        // Route::resource('kelompok', 'Dashboard\KelompokController');
        Route::get('kelompok/tambah', 'Dashboard\KelompokController@create')->name('kelompok.create');
        Route::post('kelompok/simpan', 'Dashboard\KelompokController@store')->name('kelompok.store');

        Route::get('kelompok/uep', 'Dashboard\KelompokController@showUEP')->name('admin.show.uep.index');
        Route::get('kelompok/spp', 'Dashboard\KelompokController@showSPP')->name('admin.show.spp.index');
        Route::get('kelompok/hapus', 'Dashboard\KelompokController@destroy')->name('kelompok.destroy');

        Route::get('kelompok/detail/{id}', 'Dashboard\KelompokController@detail')->name('admin.kelompok.detail');

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
        Route::get('pengajuan/kelompok', 'Dashboard\PengajuanKelompokController@showUEP')->name('show.uep.index');
        Route::get('kelompok/detail/{id}', 'Dashboard\KelompokController@detail')->name('direktur.kelompok.detail');
        Route::get('kelompok/uep', 'Dashboard\KelompokController@showUEP')->name('direktur.show.uep.index');
        Route::get('kelompok/spp', 'Dashboard\KelompokController@showSPP')->name('direktur.show.spp.index');
        Route::get('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController@index')->name('pengajuan.kelompok');
        Route::post('approval/pengajuan/kelompok', 'Dashboard\PengajuanKelompokController@approval')->name('approval.pengajuan.kelompok');
        Route::get('export/pinjaman', 'Dashboard\ReportController@list')->name('export.pinjaman');
        Route::get('/report/export-pdf', 'Dashboard\ReportController@exportPDF')->name('report.exportPdf');
        Route::get('/pinjaman', 'Dashboard\PinjamanController@index')->name('pinjaman.list');
    });

Route::prefix('kelompok')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AnggotaKelompokDashboardController@index')->name('dashboard.anggota_kelompok');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
    });
