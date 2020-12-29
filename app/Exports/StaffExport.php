<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class StaffExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{
    public function headings():array
    {
        return [
            'Nama',
            'Username',
            'Email',
            'Jabatan',
            'Tanggal Join Klinik'
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
        return User::select('name','username','email','jabatan','created_at')->where('role','staff')->get();
    }
    public function map($user):array
    {
        return [
            $user->name,
            $user->username,
            $user->email,
            $user->jabatan,
            $user->created_at,
        ];
    }
}
