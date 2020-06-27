@extends('doctor.dashboard')
@section('content')
<style>
input[type=text] {
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
<div style="font-size: 25px;padding-left: 50px;padding-top: 20px;font-weight: bold; ">Cập nhật thông tin cá nhân</div>
<hr >
<div class="editKtv">
  <form action="{{route('doctor.postEdit',['id'=>$user->id])}}" method="post">
  	     @csrf
  	<label for="email">Email</label><br>
    <input type="text"  name="email" value="{{$user->email}}" disabled=""><br>
    <label for="fname">Họ và tên</label><br>
    <input type="text"  name="fullname" value="{{$user->fullname}}"><br>
    <label for="lname">Địa chỉ</label><br>
    <input type="text"  name="address" value="{{$user->address}}"><br>
    <label for="country">Số điện thoại</label><br>
    <input type="text"  name="phone" value="{{$user->mobile}}"><br>
    <label for="country">Khoa phòng</label><br>
    <input type="text"  name="phone" value="{{$user->department->department_name}}"><br>
    <input class="btn" type="submit" value="Cập nhật thông tin" style="margin-left: 50px" ></input>
      <div class="btn">
        <a href="{{route('doctor.home')}}" style="color: black; text-decoration: none;">Hủy</a>
      </div>
  </form>
</div>
@endsection
