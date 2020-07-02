@extends('ktv.index')
@section('content')
<style type="text/css">
	input[type=text] {
		padding: 3px;
		font-size: 17px;
		border: #A4A4A4 solid 1px;
	}
	.btnsearch:hover{
		background-color: #BDBDBD;
	}
	.container2{
		margin: 20px;
		margin-top: 30px;
	}
	h2{
		margin-left: 20px;
		font-weight: bold;
	}
	.fa-arrow-circle-o-up:hover{
		border-radius: 4px;
		background-color: green;
	}
	.fa-pencil-square-o:hover{
		border-radius: 4px;
		background-color: yellow;
	}
	.fa-medkit:hover{
		border-radius: 4px;
		color: #FA8258;
	}

	/* The popup form - hidden by default */
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
		max-height: 500px;
		border-radius: 5px;
	}
	/* Full-width input fields */
	.form-container input[type=text], .form-container input[type=password], .form-container select[type=text] {
		width: 100%;
		padding: 15px;
		margin: 5px 0 5px 0;
		border: none;
		background: #f1f1f1;
	}

	/* When the inputs get focus, do something */
	.form-container input[type=text]:focus, .form-container input[type=password]:focus,.form-container select[type=text]:focus {
		background-color: #ddd;
		outline: none;
	}

	/* Set a style for the submit/login button */
	.form-container .btn {
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
	.form-container .cancel {
		background-color: red;
	}

	/* Add some hover effects to buttons */
	.form-container .btn:hover, .open-button:hover {
		opacity: 1;
	}
</style>
<script type="text/javascript">
    $("body").on("click", "#luuAnh", function () {
        var allowedFiles = [".png", ".jpg", ".giff", "tiff",""];
        var fileUpload = $("#fileUpload");
        var lblError = $("#lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.val().toLowerCase())) {
            lblError.html("Chỉ chấp nhận file chứa đuôi: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
        lblError.html('');
        return true;
    });
</script>
<h2>Danh Sách Thiết Bị Chưa Bàn Giao</h2>
<div class="container2">
	<div>
		<form action="" method="get" style="float: left;">
			<table width="100%" border="0">
				<tr>
					<td width="25%"> 
						<input style="width: 90%;" type="text" class="form-control" placeholder="Tên thiết bị" name="dv_name" value="{{request()->dv_name}}">
					</td>
					<td width="25%">
						<select class="form-control" name="provider_id" style="background-color: #D8D8D8;width: 90%">
							<option value="">Mọi nhà cung cấp</option>
							@if(isset($providers))
							@foreach($providers as $rows)
							<option value="{{ $rows->id }}" >
								{{ $rows->provider_name }}
							</option>
							@endforeach
							@endif
						</select>
					</td>
					<td width="25%">
						<select class="form-control" name="dv_type_id" style="background-color: #D8D8D8;">
							<option value="">Tất cả loại thiết bị</option>
							@if(isset($dv_types))
							@foreach($dv_types as $rows)
							<option value="{{ $rows->dv_type_id }}" > {{ $rows->dv_type_name }}
							</option>
							@endforeach
							@endif
						</select>
					</td>
					<td width="15%">
						<button class="btnsearch" type="submit" style="width: 100px;padding: 4px; margin-left: 20px"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
					</td>
					<td style="text-align: left;font-size: 18px;">Tất cả: {{$devices->total()}}</td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td width="25%"> 
						<input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
					</td>
					<td>
						<input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
					</td>
					<td colspan="2">
						<input style="width: 90%;" type="text" class="form-control" placeholder="Nhập tên dự án gói thầu" name="import_id" value="{{request()->import_id}}">
					</td>
					<td></td>
				</tr>
			</table>  
		</form>
	</div>

	<br><br><br><br><br>

	<table class="table table-condensed table-bordered table-hover">
		<thead style="background-color: #81BEF7;">
			<tr style="font-size: 17px;">
				<th>Mã thiết bị</th>
				<th>Tên thiết bị</th>
				<th>Model</th>
				<th>Loại thiết bị</th>
				<th>Nhà cung cấp</th>
				<th>Ngày nhập</th>
				<th width="10%">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			@foreach($devices as $device)
			<tr style="font-size: 15px;">
				<td>{{$device->dv_id}}</td>
				<td>{{$device->dv_name}}</td>
				<td>{{$device->dv_model}}</td>
				<td>{{$device->dv_type->dv_type_name}}</td>
				<td>{{$device->provider->provider_name}}</td>
				<td>{{$device->import_date}}</td>
				<td style="text-align: center;">
					<a href="{{route('device.getAcc',['id'=>$device->id])}}"><i class="fa fa-medkit" style="font-size: 20px;" title="Nhập vật tư kèm theo" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
					<a class="ban_giao" data-deviceid="{{$device->id}}"><i class="fa fa-arrow-circle-o-up" style="font-size: 20px;cursor: pointer;" title="Bàn giao" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
					<a href="{{route('device.getEdit',['id'=>$device->id])}}"><i class="fa fa-pencil-square-o" style="font-size: 20px;" title="Thông tin" aria-hidden="true"></i></a>
					<!-- <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('device.del',['id'=>$device->id])}}"><i class="fa fa-trash" style="font-size: 22px;" title="Xóa" aria-hidden="true"></i></a> -->
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="form-popup" id="myForm">
		<form action="{{ route('device.move', 'id') }}" class="form-container form1" enctype="multipart/form-data" method="post">
			@csrf
			<table style="font-size: 17px;" border="0" >
				<tr>
					<td colspan="2"><label for="email" style="text-align: center; font-size: 22px;"><b>Chọn khoa phòng bàn giao</b></label></td>
				</tr>
				<tr>
					<td colspan="2">
						<select class="form-control"  name="select_dept" style="font-style: 15px;">
							<option value="">Lựa chọn khoa phòng</option>
							@if(isset($depts))
							@foreach($depts as $rows)
							<option  value="{{$rows->id}}">{{$rows->department_name}}</option>
							@endforeach
							@endif
						</select>
					</td>
				</tr>
				<tr><td class="2"><br></td></tr>
				<tr>
					<td colspan="2">
						<?php $users = DB::table('users')->where('rule',3)->get() ;?>
						
						<select  class="form-control" name="receiver" required="">
							<option value="">Chọn người phụ trách ở khoa</option>
							@foreach($users as $r)
							<option value="{{ $r->user_id }}">{{ $r->fullname}} -- {{ $r->user_id}} </option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr >
					<td colspan="2"><input type="file" id="fileUpload" name="image">
						<br />
						<span id="lblError" style="color: red;"></span>
						<br />
					</td>
				</tr>
				<tr>
					<td colspan="2"><button style="margin-left: 30px;" type="submit" id="luuAnh" class="btn" onclick="return confirm('Bạn có chắc chắn bàn giao thiết bị?')">Lưu
					</button>
					<button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
				</tr>
			</table>
		</form>
	</div>

	<div class="page-nav text-right">
		<nav aria-label="Page navigation">
			{{$devices->links()}}
		</nav>
	</div>
</div>
<script>
	function openForm() {
		
		// document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
		document.getElementById("myForm").style.display = "none";
	}

	$(document).on('click', '.ban_giao', function(){
		// Lấy id của data
		var id = $(this).attr('data-deviceid');
		// Lấy action hiện tại của form theo class
		var action = $('.form1').attr('action');
		// Thay thế id data vào đoạn action của form
		var actions= $('.form1').attr('action', action.replace('id',id));
		// Hiện form
		document.getElementById("myForm").style.display = "block";
	});

</script>
@endsection

