<?php

namespace App\Exports;

use App\Device;
use App\Device_type;
use App\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class DeviceExportQuery implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    

    use Exportable;
 
	private $dept;
	private $dvt;
	private $import_id;
	private $rows = 0;

	public function __construct($dept, $dvt, $import_id)
	{
        $this->department = $dept;
        $this->dvType = $dvt;
        $this->project   = $import_id;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {	$devices = Device::latest();
    	if($this->department)
    	{
    		$devices = Device::where('department_id', $this->department);
    	}
    	if($this->dvType)
    	{
    		$devices = Device::where('dv_type_id', $this->dvType);
    	}
    	if($this->project)
    	{
    		$devices = Device::where('project', $this->project);
    	}
    	return $devices->get();	
    }
   
    /**
    * @var MedicalBill $medical_bill
    */
    public function map($devices): array
    {
    	$now = date('Y');
        $now = (int)$now;
        $im = substr($devices->import_date, 0,4);
            $im = (int)$im;
            $bg = $devices->khbd;
            $bg = (int)$bg;
            $hn = $devices->khhn;
            $hn = (int)$hn;
            $l = $now - $im;
            $gtht = $bg - $hn*$l;
    	if ($devices->status == 0){

    		return [
    		++$this->rows,
    		$devices->dv_id,
            $devices->dv_name,
            \App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
            $devices->dv_model,
            $devices->dv_serial,
            $devices->manufacturer,
            $devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị chưa bàn giao sử dụng',
            $devices->khbd,
            $devices->khhn,
            $gtht,
            $devices->produce_date,
            $devices->price,
            $devices->import_date,
            
            
            $devices->project,
            $devices->note

    	];
    }elseif ($devices->status == 1) {
    		return [
    		++$this->rows,
    		$devices->dv_id,
            $devices->dv_name,
            \App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
            $devices->dv_model,
            $devices->dv_serial,
            $devices->manufacturer,
            $devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị đang sử dụng tốt',
            $devices->khbd,
            $devices->khhn,
            $gtht,
            $devices->produce_date,
            $devices->price,
            $devices->import_date,            
            
            $devices->project,
            $devices->note

    	];
    }elseif ($devices->status == 2) {
    		return [
    		++$this->rows,
    		$devices->dv_id,
            $devices->dv_name,
            \App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
            $devices->dv_model,
            $devices->dv_serial,
            $devices->manufacturer,
            $devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị đang báo hỏng',
            $devices->khbd,
            $devices->khhn,
            $gtht,
            $devices->produce_date,
            $devices->price,
            $devices->import_date,            
            
            $devices->project,
            $devices->note

    	];
    }elseif ($devices->status == 3) {
    		return [
    		++$this->rows,
    		$devices->dv_id,
            $devices->dv_name,
            \App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
            $devices->dv_model,
            $devices->dv_serial,
            $devices->manufacturer,
            $devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị đang sửa chữa',
            $devices->khbd,
            $devices->khhn,
            $gtht,
            $devices->produce_date,
            $devices->price,
            $devices->import_date,
            
            
            $devices->project,
            $devices->note

    	];
    }elseif ($devices->status == 4){
    	return [
    		++$this->rows,
    		$devices->dv_id,
    		$devices->dv_name,
    		\App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
    		$devices->dv_model,
    		$devices->dv_serial,
    		$devices->manufacturer,
    		$devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị đã ngưng sử dụng',
            $devices->khbd,
            $devices->khhn,
            $gtht,
    		$devices->produce_date,
    		$devices->price,
    		$devices->import_date,
    		$devices->project,
    		$devices->note

    	];
    }else{
        return [
            ++$this->rows,
            $devices->dv_id,
            $devices->dv_name,
            \App\Device_type::where( ['dv_type_id'=>$devices->dv_name] )->pluck('dv_type_name')->first(),
            $devices->dv_model,
            $devices->dv_serial,
            $devices->manufacturer,
            $devices->country,
            \App\Department::where( ['id'=>$devices->department_id] )->pluck('department_name')->first(),
            $devices->handover_date,
            'Thiết bị đã thanh lý',
            $devices->khbd,
            $devices->khhn,
            $gtht,
            $devices->produce_date,
            $devices->price,
            $devices->import_date,
           
            
            $devices->project,
            $devices->note

        ];
    }
    	
    }

    public function headings(): array
    {
    	return [
            [' ', ' ', ' ',' ',' ',' ',' ',' ',' ', 'Lọc Danh Sách Thiết Bị', ' ', ' ', ' ',' ',' ',' ',' ',' ',' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' '],
            ['STT', 'Mã thiết bị', 'Tên thiết bị','Loại thiết bị', 'Model', 'Serial', 'Hãng SX','Xuất xứ','Khoa phòng','Ngày bàn giao','Tình trạng sử dụng','Giá trị ban đầu (đv %)','Khấu hao hàng năm (đv %)','Giá trị hiện tại(đv %)',  'Năm SX','Giá nhập','Ngày nhập','Dự án thầu','Ghi chú']
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
    			$event->sheet->getStyle('A3:S3')->applyFromArray($style);
                $event->sheet->getStyle('A3:S3')->applyFromArray($style2);
                $event->sheet->getDelegate()->getStyle('A1:S1')->getFont()->setSize(20);
                $event->sheet->getDelegate()->getStyle('A3:S3')->getFont()->setSize(14);
    		}
    	];
    }

    public function startCell(): string
    {
        return 'A1';
    }
}

