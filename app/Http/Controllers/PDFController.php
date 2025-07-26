<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mPDF;
use App\Models\KasusPelanggaran;
use App\Models\DetailPelanggaran;
use App\Models\Siswa;

class PDFController extends Controller
{
    // public function generatePDF($id)
    // {
    //     if (date('M') == 'Jan') {
    //         $month = 'Januari';
    //     } elseif (date('M') == 'Feb') {
    //         $month = 'Februari';
    //     } elseif (date('M') == 'Mar') {
    //         $month = 'Maret';
    //     } elseif (date('M') == 'Apr') {
    //         $month = 'April';
    //     } elseif (date('M') == 'May') {
    //         $month = 'Mei';
    //     } elseif (date('M') == 'Jun') {
    //         $month = 'Juni';
    //     } elseif (date('M') == 'Jul') {
    //         $month = 'Juli';
    //     } elseif (date('M') == 'Aug') {
    //         $month = 'Agustus';
    //     } elseif (date('M') == 'Sep') {
    //         $month = 'September';
    //     } elseif (date('M') == 'Oct') {
    //         $month = 'Oktober';
    //     } elseif (date('M') == 'Nov') {
    //         $month = 'November';
    //     } elseif (date('M') == 'Dec') {
    //         $month = 'Desember';
    //     }

    //     // Format tanggal dalam bahasa Indonesia
    //     $date = date('d') . ' ' . $month . ' ' . date('Y');
    //     // Ambil data dari database berdasarkan $id (misalnya, dari model KasusPelanggaran)
    //     $kasus = KasusPelanggaran::with('details.jenis_pelanggaran')->findOrFail($id);
    //     $totalPoin = $kasus->details->sum(function ($detail) {
    //         return $detail->jenis_pelanggaran->poin;
    //     });

    //     $html = view('pdf.kasus_pelanggaran', compact('kasus', 'totalPoin', 'date'))->render();

    //     $mpdf = new \Mpdf\Mpdf();
    //     $mpdf->WriteHTML($html);

    //     return response()->stream(
    //         function () use ($mpdf) {
    //             $mpdf->Output();
    //         },
    //         200,
    //         [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'attachment; filename="KasusPelanggaran-' . $kasus->siswa->nama_siswa . '.pdf"',
    //         ]
    //     );
    // }


    public function cetak($id)
    {
        if (date('M') == 'Jan') {
            $month = 'Januari';
        } elseif (date('M') == 'Feb') {
            $month = 'Februari';
        } elseif (date('M') == 'Mar') {
            $month = 'Maret';
        } elseif (date('M') == 'Apr') {
            $month = 'April';
        } elseif (date('M') == 'May') {
            $month = 'Mei';
        } elseif (date('M') == 'Jun') {
            $month = 'Juni';
        } elseif (date('M') == 'Jul') {
            $month = 'Juli';
        } elseif (date('M') == 'Aug') {
            $month = 'Agustus';
        } elseif (date('M') == 'Sep') {
            $month = 'September';
        } elseif (date('M') == 'Oct') {
            $month = 'Oktober';
        } elseif (date('M') == 'Nov') {
            $month = 'November';
        } elseif (date('M') == 'Dec') {
            $month = 'Desember';
        }

        // Format tanggal dalam bahasa Indonesia
        $date = date('d') . ' ' . $month . ' ' . date('Y');
        // Ambil data dari database berdasarkan $id (misalnya, dari model KasusPelanggaran)
        $kasus = KasusPelanggaran::with('details.jenis_pelanggaran', 'siswa.kelas')->findOrFail($id);
        $totalPoin = $kasus->details->sum(function ($detail) {
            return $detail->jenis_pelanggaran->poin;
        });

        $namaKelas = $kasus->siswa->kelas->nama_kelas;

        return view('pdf.cetak_pelanggaran', compact('kasus', 'totalPoin', 'date', 'namaKelas'))->render();

        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML($html);

        // return response()->stream(
        //     function () use ($mpdf) {
        //         $mpdf->Output();
        //     },
        //     200,
        //     [
        //         'Content-Type' => 'application/pdf',
        //         'Content-Disposition' => 'attachment; filename="KasusPelanggaran-' . $kasus->siswa->nama_siswa . '.pdf"',
        //     ]
        // );
    }
}
