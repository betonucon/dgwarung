<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Warga;

class WargaImport implements ToModel, WithStartRow,WithCalculatedFormulas
{
    
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        
        return Warga::updateOrCreate(
            [
                'nik'=>$row[0],
                
                
            ],
            [
                'no_kk'=>$row[1],
                'nama'=>$row[2],
                'rw'=>sprintf("%03s",  $row[3]),
                'rt'=>sprintf("%03s",  $row[4]),
                'alamat'=>$row[5],
                'j_kelamin'=>$row[6],
                'tempat_lahir'=>$row[7],
                'tanggal_lahir'=>$row[8],
                'email'=>$row[9],
                'no_hp'=>$row[10],
                'status_pernikahan'=>$row[11],
                'pekerjaan_id'=>$row[13],
                'agama'=>$row[12],

            ],
        );
            
        
    }

    public function startRow(): int
    {
        return 2;
    }
}
