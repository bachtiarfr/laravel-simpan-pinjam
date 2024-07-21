<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\DB; // Import DB facade
use Barryvdh\DomPDF\Facade as PDF; // Import PDF facade
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function list()
    {
        if (request()->ajax()) {
            // Use a raw SQL query to handle complex operations
            $query = DB::select(DB::raw('
                SELECT 
                    @row_number := @row_number + 1 AS row_number,
                    pinjaman.created_at, 
                    pinjaman.nominal, 
                    pinjaman.status, 
                    pinjaman.jangka_waktu, 
                    anggota_kelompok.nama_kelompok, 
                    jenis_kelompok.name AS jenis_kelompok,
                    COUNT(bayar_pinjaman.id) AS angsuran_ke
                FROM 
                    pinjaman
                JOIN 
                    anggota_kelompok ON anggota_kelompok.id = pinjaman.id_kelompok
                JOIN 
                    jenis_kelompok ON anggota_kelompok.jenis_kelompok_id = jenis_kelompok.id
                LEFT JOIN 
                    bayar_pinjaman ON bayar_pinjaman.pinjaman_id = pinjaman.id
                CROSS JOIN 
                    (SELECT @row_number := 0) AS t
                GROUP BY 
                    pinjaman.id, pinjaman.created_at, pinjaman.nominal, pinjaman.status, pinjaman.jangka_waktu, anggota_kelompok.nama_kelompok, jenis_kelompok.name
                ORDER BY 
                    pinjaman.created_at ASC
            '));

            return DataTables::of($query)->make();
        }

        return view('direktur.report.report_pinjaman');
    }

    public function exportPdf()
    {
        // Fetch the data
        $query = DB::select(DB::raw('
            SELECT 
                @row_number := @row_number + 1 AS row_number,
                pinjaman.created_at, 
                pinjaman.nominal, 
                pinjaman.status, 
                pinjaman.jangka_waktu, 
                anggota_kelompok.nama_kelompok, 
                jenis_kelompok.name AS jenis_kelompok,
                COUNT(bayar_pinjaman.id) AS angsuran_ke
            FROM 
                pinjaman
            JOIN 
                anggota_kelompok ON anggota_kelompok.id = pinjaman.id_kelompok
            JOIN 
                jenis_kelompok ON anggota_kelompok.jenis_kelompok_id = jenis_kelompok.id
            LEFT JOIN 
                bayar_pinjaman ON bayar_pinjaman.pinjaman_id = pinjaman.id
            CROSS JOIN 
                (SELECT @row_number := 0) AS t
            GROUP BY 
                pinjaman.id, pinjaman.created_at, pinjaman.nominal, pinjaman.status, pinjaman.jangka_waktu, anggota_kelompok.nama_kelompok, jenis_kelompok.name
            ORDER BY 
                pinjaman.created_at ASC
        '));

        // Load view and pass data
        $pdf = PDF::loadView('direktur.report.pdf_report', ['data' => $query]);

        // Download PDF file
        return $pdf->download('report_pinjaman.pdf');
    }
}
