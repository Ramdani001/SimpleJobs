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
            ->where('is_active', true)
            ->orderBy('created_at','desc')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Nama' => $item->name,
                    'Kondisi' => $item->condition->name,
                    'Jumlah' => $item->quantity,
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
            'Tanggal Dibuat'
        ];
    }
}
