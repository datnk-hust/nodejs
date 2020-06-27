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
  font-size: 20px;
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
		margin-left: 300px;
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
	<div style="font-size: 35px;font-weight: bold;">Lịch sử điều chuyển thiết bị</div>
	<hr>
	<thead>
		<th>ID</th>
		<th>Tên thiết bị</th>
		<th>Thời gian điều chuyển</th>
		<th>Tới khoa phòng</th>
		<th>Người tạo phiếu điều chuyển</th>
	</thead>
	<tbody>
		<tr>abc</tr>
		<tr>a</tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
	</tbody>
</div>
@endsection