<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromView, WithStyles, WithColumnWidths, WithEvents
{
    private $orders;
    public function __construct($orders)
    {
        $this->orders = $orders;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // All headers in the first row
            1 => [
                'font' => ['bold' => true, 'size' => 14,],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Vertically center other rows
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, // Fill type solid
                    'startColor' => [
                        'rgb' => 'C0C0C0', // Gray background (hex: #C0C0C0)
                    ],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set thin border
                        'color' => ['rgb' => '000000'], // Black border color
                    ],
                ],
            ],
            2 => [
                'font' => [
                    'size' => 12, // Set font size to 12 for other rows
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Vertically center other rows
                ],
            ],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Width for 'Customer' column
            'B' => 20, // Width for 'Payment Type' column
            'C' => 25, // Width for 'Total Amount' column
            'D' => 20, // Width for 'Admin' column
            'E' => 20, // Width for 'Status' column
            'F' => 25, // Width for 'Order Date' column
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set header row height (row 1)
                $sheet->getRowDimension(1)->setRowHeight(30); // Set header height to 30

                // Set other rows height (rows 2 and beyond)
                for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(20); // Set other rows height to 20
                }

                $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
    public function view(): View
    {
        return view('admin.exports.order', [
            "status" => request()["type"],
            'orders' => $this->orders
        ]);
    }
}
