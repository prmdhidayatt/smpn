<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * Maps each row of the Excel file to a Siswa model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nisn'           => $row['nisn'],
            'nama_siswa'     => $row['nama'], // Mapping dari kolom Excel 'nama'
            'jk_siswa'       => $row['jenis kelamin'],
            'alamat'         => $row['alamat'],
            'tahun_ajaran'   => $row['tahun ajaran'],
            'nama_wali'      => $row['nama wali'],
        ]);
    }
}
