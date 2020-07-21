@extends('header_main')
@section('content')
<style type="text/css">
  .ban_giao{
    cursor: pointer;
  }
  .ban_giao:hover{
    background-color: red;
  }
  .form-popup {
    display: none;
    position: fixed;
    top: 300px;
    bottom: 200px;
    left: 500px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 350px;
    border-radius: 5px;
  }

  
  /* Full-width input fields */
  .form-container input[type=text],.form-container select[type=text]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
    font-size: 18px;
  }
 
  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,.form-container select[type=text]:focus{
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn{
    background-color: #4CAF50;
    font-size: 20px;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 150px;
    margin-left:10px;
    opacity: 0.7;
  }
  /* Add a red background color to the cancel button */
  .form-container .cancel{
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }
</style>
<br>
<div>
	<form class="form-group" action="" method="get">
		<table>
			<tr>
				<td width="25%">
					<div style="margin-left: 50px;"><input type="text" name="dvId" class="form-control" placeholder="Nhập mã thiết bị "></div>
				</td>
				<td width="15%"> 
           		 <div style="margin-left: 5px;" >
            	<input  type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" >
            	</div>
         		 </td>
          		<td width="15%">
            		<div style="margin-left: 5px;">
            	<input  type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" >
            		</div>
          		</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select name="dept" class="form-control">
							<?php $depts = DB::table('department')->get(); ?>
						<option value="">Chọn khoa phòng</option>
						@foreach($depts as $d)
						<option value="{{ $d->id }}">{{ $d->department_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select  name="dvt" class="form-control">
						<option value="">Chọn loại thiết bị</option>
						<?php $dvts = DB::table('device_type')->get(); ?>
						@foreach($dvts as $r1)
						<option value="{{ $r1->dv_type_id }}">{{ $r1->dv_type_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="25%">
					<div style="margin-left: 5px;"> <button class="btn btn-primary">Tìm kiếm </button></div>
				</td>
			</tr>
		</table>
	</form>
	
	</div>
<div style="margin-left: 50px;width: 95%">
		@if(count($devices))
	<div >
		<h3><b>Chọn các thiết bị có thể tương thích với vật tư</b> </h3>
	</div>
	<form method="post" action="{{ route('acc.postSelectDev',['id'=>$id]) }}">
		@csrf
		<button class="btn btn-success" style="float: right;">Lưu lựa chọn</button>
		<br><br>
		<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="15%">Mã thiết bị</th>
				<th width="25%">Tên thiết bị</th>
				<th width="10%">Model</th>
				<th width="10%">Serial</th>
				<th width="20%">Loại thiết bị</th>
				<th width="5%">Năm SX</th>
				<th width="5%">Tùy chọn</th>
			</thead>
			<tbody>
				
				@foreach($devices as $r)
				<tr>
					<td>{{ $r->dv_id }}</td>
					<td>{{ $r->dv_name }}</td>
					<td>{{ $r->dv_model }}</td>
					<td>{{ $r->dv_serial }}</td>
					<td>{{ \App\Device_type::where(['dv_type_id'=>$r->dv_type_id])->pluck('dv_type_name')->first() }}</td>
					<td>{{ $r->produce_date }}</td>
					<td style="text-align: center;">
						<input class="form-control" type="checkbox" name="selected[]" value="{{$r->id}}">
					</td>
					
				</tr>
				@endforeach
				
			</tbody>
		</table>
		</form>
		@endif
</div>
<br><br>

<div style="margin-left: 50px;width: 95%">
	<h3><b>Danh sách thiết bị có thể sử dụng vật tư</b></h3>
	<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="15%">Mã thiết bị</th>
				<th>Tên thiết bị</th>
				<th>Model</th>
				<th>Serial</th>
				<th>Năm sản xuất</th>
				<th>Ghi chú</th>
				<th></th>
				
			</thead>
			<tbody>
				@if(isset($accDevices))
				@foreach($accDevices as $r)
				<tr>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_id')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_name')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_model')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('dv_serial')->first() }}</td>
					<td>{{\App\Device::where(['id'=> $r->dv_id])->pluck('produce_date')->first() }}</td>
					@if($r->status == 1)
					<td>Vật tư kèm theo thiết bị</td>
					<td></td>
					@else
					<td>Vật tư có thể được sử dụng cho thiết bị</td>
					<td>
						<a class="ban_giao" data-deviceid="{{$r->id}}"><i class="fa fa-share " title="Bàn giao cho thiết bị" style="font-size: 20px" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('del.dv_accessory',['id'=>$r->id]) }}"><i class="fa fa-trash " title="Xóa" style="font-size: 20px" aria-hidden="true"></i></a>
					</td>
					@endif
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
</div>

<!-- form cập nhật tình trạng sửa chữa -->
<div class="form-popup" id="myForm">
    <form action="{{route('device.accessory','id')}}" class="form-container form" method="post">
      @csrf
      <table>
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 20px;"><b>Thông tin bàn giao</b></label></td>
        </tr>
        <tr><td colspan="2"><hr style="height: 3px;background-color: green;"></td></tr>
        <tr>
          <td colspan="2"><div style="margin-left: 10px;"><span style="font-size: 20px;font-weight: bold;">Số lượng</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="amount" style="width: 300px;height: 40px;margin-left: 45px;" required></div></td>
        </tr>
        <tr>
          <td colspan="2"><div style="margin-left: 10px;"><span style="font-size: 20px;font-weight: bold;">Ngày bàn giao</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="date"  name="export_date" style="width: 300px;height: 40px;border-radius: 5px;" value="{{ date('Y-m-d')}}" ></div></td>
        </tr>
        <tr>
          <td colspan="2"><div style="padding: 10px;margin-left: 50px;"><button type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn bàn giao vật tư này cho thiết bị?')">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></div></td>
        </tr>
      </table>
    </form>
  </div>

  <script type="text/javascript">
  	

  	function closeForm() {
        document.getElementById("myForm").style.display = "none";
  }
  	 $(document).on('click', '.ban_giao', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
  });
  </script>
@endsection