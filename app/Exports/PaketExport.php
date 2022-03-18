<?php

namespace App\Exports;

use App\Paket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PaketExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'id_outlet',
            'Jenis',
            'Nama Paket',
            'Harga',
            'Dibuat',
            'Diupdate',
        ];
    }
    public function collection()
    {
        return Paket::all();
    }
}
