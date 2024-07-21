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
        Route::get('direktur/list', 'Dashboard\UserController@showPegawai')->name('show.direktur');
        
        Route::resource('user', 'Dashboard\UserController');
        
        Route::get('user/detail/{id}', 'Dashboard\UserController@detail')->name('user.detail');

        Route::get('direktur/tambah', 'Dashboard\UserController@addDirektur')->name('direktur.create');
        Route::get('pegawai/tambah', 'Dashboard\UserController@addPegawai')->name('pegawai.create');

        Route::delete('direktur/hapus', 'Dashboard\UserController@direkturDelete')->name('direktur.delete');
        Route::delete('pegawai/hapus', 'Dashboard\UserController@pegawaiDelete')->name('pegawai.delete');

        Route::post('pegawai/simpan', 'Dashboard\UserController@storePegawai')->name('pegawai.store');
        Route::post('direktur/simpan', 'Dashboard\UserController@storeDirektur')->name('direktur.store');

        // Route::resource('kelompok', 'Dashboard\KelompokController');
        Route::get('kelompok/uap', 'Dashboard\KelompokController@showUEP')->name('show.uap.index');
        Route::get('kelompok/spp', 'Dashboard\KelompokController@showSPP')->name('show.spp.index');
        Route::get('kelompok/hapus', 'Dashboard\KelompokController@destroy')->name('kelompok.destroy');

        Route::get('kelompok/detail/{id}', 'Dashboard\KelompokController@detail')->name('kelompok.detail');

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
        Route::get('kelompok/uep', 'Dashboard\KelompokController@showUEP')->name('direktur.show.uep.index');
        Route::get('kelompok/spp', 'Dashboard\KelompokController@showSPP')->name('direktur.show.spp.index');
        Route::get('pinjaman_pdf', 'Dashboard\PinjamanController@cetak_pdf')->name('pinjaman.pdf');
        Route::get('pinjaman_excel', 'Dashboard\PinjamanController@cetak_excel')->name('pinjaman.excel');
        Route::get('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController@index')->name('pengajuan.kelompok');
        Route::post('approval/pengajuan/kelompok', 'Dashboard\PengajuanKelompokController@approval')->name('approval.pengajuan.kelompok');
        Route::get('export/pinjaman', 'Dashboard\ReportController@list')->name('export.pinjaman');
        Route::get('/report/export-pdf', 'Dashboard\ReportController@exportPDF')->name('report.exportPdf');

    });

Route::prefix('kelompok')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'Dashboard\AnggotaKelompokDashboardController@index')->name('dashboard.anggota_kelompok');
        Route::resource('pinjaman', 'Dashboard\PinjamanController');
        Route::get('bayar-pinjaman/{id}', 'Dashboard\PinjamanController@bayar_pinjaman')->name('pinjaman.bayar');
        Route::resource('pengajuan-kelompok', 'Dashboard\PengajuanKelompokController');
    });
