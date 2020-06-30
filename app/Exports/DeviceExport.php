<?php

namespace App\Exports;

use App\Device;
use App\Device_type;
use App\Provider;
use App\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class DeviceExport implements FromCollection , WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $dvs = Device::all();
        $dv = array();
        $now = date('Y');
        $now = (int)$now;

        foreach ($dvs as $row) {
            $im = substr($row->import_date, 0,4);
            $im = (int)$im;
            $bg = $row->khbd;
            $bg = (int)$bg;
            $hn = $row->khhn;
            $hn = (int)$hn;
            $l = $now - $im;
            $gtht = $bg - $hn*$l;
            if($row->status == 0){
            $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị chưa bàn giao sử dụng",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
        }
            elseif ($row->status == 1){
                $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị đang sử dụng",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
            }elseif ($row->status == 2) {
                $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị đang báo hỏng",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
            }elseif ($row->status == 3) {
                $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị đang sửa chữa",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
            }elseif ($row->status == 4){
                $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị đã ngưng sử dụng",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
            }else{
                $dv[] = array(
                '0' => count($dv)+1,
                '1' => $row->dv_id,
                '2' => $row->dv_name,
                '3' => $row->dv_model,
                '4' => $row->dv_serial,
                '5' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '6' => $row->group,
                '7' => $row->produce_date,
                '8' => $row->manufacturer,
                '9' => $row->country,
                '10' => \App\Department::where(['id'=>$row->department_id])->pluck('department_name')->first(),
                '11' => $row->handover_date,  
                '12' => "Thiết bị đã thanh lý",            
                '13' => $row->khbd,
                '14' => $row->khhn,
                '15' => $gtht, 
                '16' => $row->price,
                '17' => $row->import_date,
                '18' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),  
                '19' => $row->import_id,
                '20' => $row->note
            );
            }
        }

        return (collect($dv));
    }
    
    public function headings(): array
    {
        return [
            [' ', ' ', ' ',' ',' ',' ',' ',' ',' ',' ', 'Danh Sách Toàn Bộ Thiết Bị',' ', ' ', ' ', ' ',' ',' ',' ',' ',' ',' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ',' '],
            [
            'STT',
            'Mã thiết bị',
            'Tên thiết bị',
            'Model',
            'Serial',
            'Loại thiết bị',
            'Nhóm thiết bị',
            'Năm sản xuất',
            'Hãng sản xuất',
            'Xuất xứ',
            'Khoa phòng',
            'Ngày bàn giao',
            'Tình trạng sử dụng',
            'Giá trị ban đầu (%)',
            'Khấu hao hàng năm (%)',
            'Giá trị hiện tại (%)',
            'Giá nhập',
            'Ngày nhập',
            'Nhà cung cấp',
            'Dự án thầu',
            'Ghi chú'
        ]
        ];
    }

    public function registerEvents(): array
    {
        $style = [
            'font' => [
                'bold' => true,
            ]
        ];

        $style2 = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($style, $style2) {
                $event->sheet->getStyle('D1')->applyFromArray($style);
                $event->sheet->getStyle('D1')->applyFromArray($style2);
                $event->sheet->getStyle('A3:U3')->applyFromArray($style);
                $event->sheet->getStyle('A3:U3')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A1:U1')->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A3:U3')->getFont()->setSize(14);
            }
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }
}
