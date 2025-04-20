<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarisExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Inventaris::with('condition')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Nama' => $item->name,
                    'Kondisi' => $item->condition->name,
                    'Jumlah' => $item->quantity,
                    'Aktif' => $item->is_active ? 'Aktif' : 'Tidak Aktif',
                    'Dibuat Oleh' => $item->created_by,
                    'Tanggal Dibuat' => $item->created_at->format('d-m-Y H:i')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Kondisi',
            'Jumlah',
            'Aktif',
            'Dibuat Oleh',
            'Tanggal Dibuat'
        ];
    }
}
