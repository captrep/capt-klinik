<?php

namespace App\Exports;


use App\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PasienExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping,WithEvents
{
    public function headings():array
    {
        return [
            'Nama',
            'Umur',
            'Nomor KTP',
            'Jenis Kelamin',
            'Alamat',
            'Handphone',
            'Tanggal Daftar Pasien'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => 'true',
                        'size' => '12'
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
               
            }
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pasien::select('nama','umur','noktp','jenkel','alamat','nohp','created_at')->get();
    }
    public function map($pasien):array
    {
        return [
            $pasien->nama,
            $pasien->umur,
            $pasien->noktp,
            $pasien->jenkel,
            $pasien->alamat,
            $pasien->nohp,
            $pasien->created_at,
        ];
    }
}
