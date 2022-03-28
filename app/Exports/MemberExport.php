<?php

namespace App\Exports;

use App\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MemberExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'Nama Member',
            'Alamat',
            'Jenis Kelamin',
            'Telp',
            'Dibuat',
            'Diupdate',
        ];
    }
    public function collection()
    {
        return Member::all();
    }
}
