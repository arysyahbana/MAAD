<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UserRekapExport implements FromCollection, WithHeadings, WithStyles
{
    protected $userPost;

    public function __construct($userPost)
    {
        $this->userPost = $userPost;
    }

    public function collection()
    {
        return $this->userPost->map(function ($user) {
            return [
                'Nama User' => $user->name,
                'Email' => $user->email,
                'NIM' => $user->nim,
                'Tahun Masuk' => $user->formatted_nim, // Gunakan formatted_nim yang telah dihasilkan
                'Jenis Kelamin' => $user->gender,
                'Skill' => $user->skill,
                'Status' => $user->status,
                'Tempat Bekerja' => $user->place,
                'Kontrak sampai tanggal' => \Carbon\Carbon::parse($user->contract)->format('d F Y'),
                'No HP' => $user->hp,
                'Instagram' => $user->instagram,
                'Twitter' => $user->twitter,
                'Total Postingan' => $user->post_count,
                'Postingan Photo' => $user->photo_count,
                'Postingan Video' => $user->video_count,
                'Postingan Audio' => $user->audio_count,
                'Status Akun' => $user->role,

            ];
        });
    }

    public function headings(): array
    {
        // Sesuaikan judul ini berdasarkan struktur tabel Anda
        return [
            'Nama User',
            'Email',
            'NIM',
            'Tahun Masuk',
            'Jenis Kelamin',
            'Skill',
            'Status',
            'Tempat Bekerja',
            'Kontrak sampai tanggal',
            'No HP',
            'Instagram',
            'Twitter',
            'Total Postingan',
            'Postingan Photo',
            'Postingan Video',
            'Postingan Audio',
            'Status Akun',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(40);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(25);
        $sheet->getColumnDimension('K')->setWidth(25);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(20);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(20);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(20);

        return [
            'A1:Q1' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thick'
                    ]
                ],
                'font' => [
                    'size' => '12',
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => "79E0EE"],
                ],
            ],

            'A2:Q100' => [
                'font' => [
                    'size' => '12'
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ],
            ],

        ];
    }
}
