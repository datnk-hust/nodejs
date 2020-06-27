<!DOCTYPE html>
<html>
<head>
	<title>Phiếu xin bàn giao thiết bị</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/times.ttf');
		font-style: normal; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesbd.ttf');
		font-weight: bold; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesi.ttf');
		font-style: italic; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesbi.ttf');
		font-style: italic; 
		font-weight: bold;
	}
	* {
		font-family: Times New Roman !important;
	}
	.font-bold {
		font-weight: bold;
	}
	.font-italic {
		font-style: italic;
	}
	body{
		margin: auto;
	}
	table{
		width: 100%;
		border-collapse: collapse;
	}
</style>
<body>
	<div>
		<table style="font-size: 20px;" width="100%">
			<tr>
				<td class="font-bold" style="text-align: center;">Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam</td>
			</tr>
			<tr>
				<td class="font-bold" style="text-align: center;">Độc lập - Tự do - Hạnh phúc</td>
			</tr>
			<tr>
				<td>
					<div style="margin-top: 50px;font-size: 22px;text-align: center; " class="font-bold">PHIẾU XIN BÀN GIAO THIẾT BỊ</div>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="font-size: 17px;">
			<tr>
				<td class="font-bold">Kính gửi: </td>
				<td>Trưởng Phòng Quản Lý Vật Tư Trang Thiết Bị</td>
			</tr>
			<tr>
				<td class="font-bold">Lý do:</td>
				<td>Khoa phòng đang thiếu thiết bị cần bổ sung để đảm bảo hoạt động</td>		
			</tr>
		</table>
	</div>
	<div>
		<h3 class="font-bold">I. Thông tin về thiết bị </h3><br>
		<table width="100%" style="font-size: 17px;">
			<tr class="font-bold">
				<td style="border: 1px solid black;">Mã thiết bị</td>
				<td style="border: 1px solid black;">Tên thiết bị</td>
				<td style="border: 1px solid black;">Model</td>
				<td style="border: 1px solid black;">Số lượng</td>
				<td style="border: 1px solid black;">Tình trạng</td>
				<td style="border: 1px solid black;">Năm SX</td>
			</tr>
				<tr>
					<td style="border: 1px solid black;"> {{$device-> dv_id}}</td>
					<td style="border: 1px solid black;"> {{$device->dv_name}}</td>
					<td style="border: 1px solid black;"> {{$device->model}}</td>
					<td style="border: 1px solid black;"> 1 </td>
					<td style="border: 1px solid black;"> Chưa bàn giao</td>
					<td style="border: 1px solid black;"> {{$device->produce_date}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div>
		<h3 class="font-bold">II. Thông tin vật tư kèm theo</h3><br>
		<table  width="100%" style="font-size: 17px;">
			<tr class="font-bold">
				<td style="border: 1px solid black;" width="30%">Tên vật tư</td>
				<td style="border: 1px solid black;" width="10%">Model</td>
				<td style="border: 1px solid black;" width="10%">Số lượng</td>
				<td style="border: 1px solid black;" width="10%">ĐVT</td>
				<td style="border: 1px solid black;" width="10%">Năm SX</td>
				<td style="border: 1px solid black;" width="20%">Tình trạng</td>
			</tr>
				@if(isset($acc))
				@foreach($acc as $r)
			<tr>
					<td style="border: 1px solid black;"> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('acc_name')->first() }}</td>
					<td style="border: 1px solid black;"> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('model')->first() }}</td>
					<td style="border: 1px solid black;"> {{$r->amount}}</td>
					<td style="border: 1px solid black;"> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('unit')->first()}}</td>
					<td style="border: 1px solid black;"> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('produce_date')->first() }}</td>
					<td style="border: 1px solid black;"> Chưa sử dụng</td>
			</tr>
				@endforeach
				@endif

		</table>
	</div>
	<br><br>
	<div>
		<table width="100%" style="font-size: 18px;">
			<tr>
				<td width="50%"></td>
				<td style="text-align: center;">Ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</td>
			</tr>
			<tr>
				<td>Xác nhận của Phòng vật tư</td>
				<td style="text-align: center;">Khoa phòng xin bàn giao</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><br></td>
				<td style="text-align: center;" class="font-bold"> {{ \App\Department::where(['id'=>Auth::user()->department_id])->pluck('department_name')->first() }}
				</td>
			</tr>
		</table>
	</div>
</body>
</html>



				