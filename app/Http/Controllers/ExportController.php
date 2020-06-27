<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller implements FromCollection, WithHeadings
{
    //
    use Exportable;

    public function collection()
    {
        $orders = Order::all();
        foreach ($orders as $row) {
            $order[] = array(
                '0' => $row->id,
                '1' => $row->name,
                '2' => $row->address,
                '3' => $row->email,
                '4' => $row->order_date,
                '5' => number_format($row->total),
            );
        }

        return (collect($order));
    }
    public function headings(): array
    {
        return [
            'id',
            'Tên',
            'Địa chỉ',
            'Email',
            'Ngày đặt hàng',
            'Tổng',
        ];
    }
    
}
}
