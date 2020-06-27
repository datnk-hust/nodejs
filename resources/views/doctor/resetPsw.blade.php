@extends('doctor.dashboard')
@section('content')
<style>
input[type=password] {
  width: 520px;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
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
  padding-top: 50px;
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="editKtv">
  <form action="{{route('doctor.postPsw',['id'=>$user->id])}}" method="post">
         @csrf
    <label for="password">Nhập mật khẩu cũ</label><br>
    <input type="password"  name="current_psw" ><br>
    <label for="password">Nhập mật khẩu mới</label><br>
    <input type="password"  name="new_psw" ><br>
    <label for="password">Nhập lại mật khẩu mới</label><br>
    <input type="password"  name="repeat_psw" ><br>
    <input class="btn" type="submit" value="Đổi mật khẩu" style="margin-left: 50px" ></input>
    <div class="btn"><a href="{{route('doctor.home')}}" style="color: black; text-decoration: none;">Hủy</a></div>
  </form>
</div>
@endsection
