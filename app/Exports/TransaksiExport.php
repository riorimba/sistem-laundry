<?php

namespace App\Exports;

use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class TransaksiExport implements FromQuery, WithHeadings
// FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            '#',
            'Outlet',
            'Member',
            'Paket',
            'Berat(Kg)',
            'Tanggal Transaksi',
            'Batas Waktu',
            'Tanggal Bayar',
            'Status',
            'Pembayaran',
            'create_at',
            'update_at'
        ];
    }

    use Exportable;

    public function query()
    {
        return Transaksi::query();
    }
}
