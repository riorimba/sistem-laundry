<?php

namespace App\Exports;

use App\Outlet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class OutletExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'Nama Outlet',
            'Alamat',
            'Telp',
            'Dibuat',
            'Diupdate',
        ];
    }
    public function collection()
    {
        return Outlet::all();
    }
}
