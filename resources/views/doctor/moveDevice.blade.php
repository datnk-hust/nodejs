@extends('doctor.dashboard')
@section('content')
<style type="text/css">
	input[type=text], input[type=date]{
  width: 450px;
  padding: 5px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 17px;
    height: 50px;

}
select[type=text]{
  width: 450px;
  padding: 5px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
  background-color: #D8D8D8;
  height: 50px;
}
.btn{
  width: 100px;
  background-color: green;
  color: black;
  padding: 7px;
  margin: 7px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 5px;
  height: 50px;
}
.btn:hover{
	opacity: 1;
}
.moveDev{
		margin-left: 400px;
		margin-top: 40px;
	}
hr{
		height: 2px;
		background-color: green;
		width: 700px;
		margin-left: 0px;
	}
.tab {
		margin-left: 100px;
	}
</style>

<div class="moveDev">
	<div style="font-size: 35px;font-weight: bold;"> Phiếu điều chuyển thiết bị</div>
	<hr>
	<div>
		<form action="{{ route('doctor.postMoveDev',['id' =>Auth::id()]) }}" method="post">
		@csrf
		<table border="0" class="tab">
			<tr style="padding: 5px;">
				<td colspan="2">
					<select type="text" name="dv_id" required>
						<option value="">Lựa chọn thiết bị cần điều chuyển</option>
						@if(isset($devices))
						@foreach($devices as $row)
						<option value="{{$row->id}}">{{$row->dv_name}}</option>
						@endforeach
						@endif
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2"><div style="padding-top: 20px;padding-left: 0px;  font-size: 20px;font-weight: bold;">Nội dung</div></td>
			</tr>
			<tr>
				<td><input type="text" name="reason" value="Điều chuyển thiết bị"></td>
			</tr>
			<tr style="padding: 5px;">
				<td colspan="2">
					<div style="margin-top: 20px;"><select type="text" name="dept_name" required>
						<option value="">Lựa chọn khoa phòng điều chuyển đến</option>
						@if(isset($depts))
						@foreach($depts as $row)
						@if($row->id != Auth::user()->department_id)
						<option value="{{$row->id}}">{{$row->department_name}}</option>
						@endif
						@endforeach
						@endif
					</select></div>
				</td>
			</tr>
			<tr>
				<td><div style="padding-top: 20px;padding-left: 0px; font-size: 20px;font-weight: bold;">Thời gian điều chuyển</div></td>
			</tr>
			<tr>
				<td><input type="date" name="req_date" value="{{date('Y-m-d')}}" ></td>
			</tr>
			<tr>
				<td colspan="2"><div style="padding: 20px;text-align: center;">
					<button type="submit" name="btn" class="btn">Lưu</button><a class="btn" href="{{route('doctor.home')}}">Hủy</a>
				</div></td>
			</tr>
		</table>
		</form>
	</div>
</div>
@endsection