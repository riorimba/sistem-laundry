<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Permission\Models\Role;


class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Email',
            '',
            '',
            'create_at',
            'update_at',
        ];
    }

    public function collection()
    {
        return User::all();
    }
}
