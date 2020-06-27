@extends('ktv.index')
@section('content')
<style>
input[type=text] , select{
  width: 520px;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}

.btn {
  width: 200px;
  background-color: #4CAF50;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
}

.btn:hover  {
  background-color: #45a049;
  color: black;
}

.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding-left:  400px;
  padding-top: 30px;
}
hr {
	background-color: #4CAF50;
	height: 2px;
	padding: 1px;
	margin-left:  50px;
	margin-right: 50px;
}
label {
	font-size: 20px;
}
</style>
<div style="font-size: 25px;padding-left: 50px;padding-top: 20px;font-weight: bold; ">Cập nhật thông tin hoạt động bảo dưỡng</div>
<hr >
<div class="editKtv">
  <form action="{{route('postEditAct.ktv',['id'=>$act->id])}}" method="post">
  	     @csrf
  	<label >Tên hoạt động bảo dưỡng</label><br>
    <input type="text"  name="actName" value="{{$act->scheduleAct}}"><br>
    <label for="fname">Tần suất thực hiện</label><br>
    <select name="fq">
      <option value="">{{ $act->scheduleTime}}</option>
      <option value="1 tuần">1 tuần</option>
      <option value="1 tháng">1 tháng</option>
      <option value="2 tháng">2 tháng</option>
      <option value="3 tháng">3 tháng</option>
      <option value="4 tháng">4 tháng</option>
      <option value="5 tháng">5 tháng</option>
      <option value="6 tháng">6 tháng</option>
      <option value="12 tháng">12 tháng</option>
    </select><br>
    <label >Ghi chú</label><br>
    <input type="text"  name="note" value="{{$act->note}}"><br>
    <input class="btn" type="submit" value="Cập nhật thông tin" style="margin-left: 150px" ></input>
      
  </form>
</div>
@endsection
