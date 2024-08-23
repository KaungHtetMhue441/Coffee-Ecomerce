<?php

namespace App\Excel\Export;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleExport implements FromCollection, WithHeadings
{
    public function view(): View
    {
        $sales = Sale::where("status", "complete")->get();
        return view('exports.invoices', [
            'invoices' => $sale
        ]);
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return User::select("id", "name", "email")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "Name", "Email"];
    }
}
