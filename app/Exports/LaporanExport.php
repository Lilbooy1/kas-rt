<?php

namespace App\Exports;

use App\Models\Iuran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Iuran::with('warga.user');
        
        if ($this->bulan && $this->tahun) {
            $query->where('bulan', $this->bulan)
                  ->where('tahun', $this->tahun);
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Warga',
            'Bulan',
            'Tahun',
            'Jumlah',
            'Status',
            'Tanggal Bayar',
            'Keterangan'
        ];
    }

    public function map($iuran): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $iuran->warga->user->name ?? 'N/A',
            $iuran->bulan,
            $iuran->tahun,
            $iuran->jumlah,
            $iuran->status,
            $iuran->tanggal_bayar ? $iuran->tanggal_bayar->format('d/m/Y') : '-',
            $iuran->keterangan ?? '-'
        ];
    }
}