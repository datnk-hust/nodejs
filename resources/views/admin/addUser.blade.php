@extends('admin.master')
@section('content')
<!-- -->
<style type="text/css">
  input[type=text], input[type=password],input[type=email], select {
    width: 300px;
    height: 40px;
  }
</style>
 <h1>Thêm một người dùng</h1>
 <div class="container_add">
 	<div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
 	@if(count($errors) > 0)
 		<div class="alert alert-danger">
 			@foreach($errors->all() as $error)
 				{{$error}}<br>
 			@endforeach 
 		</div>
 	@endif
 	@if(session('message'))
 		<div class="alert alert-success">
 			{{session('message')}}
 		</div>
 	@endif
 </div>
 <hr>
<form action="{{route('post.user')}}" method="post" class="form">
	@csrf
    <table class="addUser" border="0" width="600px;">
      <tr>
        <td width="40%"><label ><b>Mã người dùng:</b></label></td>
        <td><input type="text"  name="user_id" required class="form-control"></td>
      </tr>
      <tr>
        <td width="40%"><label ><b>Họ và tên:</b></label></td>
        <td><input type="text"  name="fullname" required class="form-control"></td>
      </tr>
      <tr>
        <td><label ><b>Địa chỉ:</b></label></td>
        <td><input type="text"  name="address" class="form-control"></td>
      </tr>
      <tr>
        <td><label ><b>Phone:</b></label></td>
        <td><input type="text"  name="phone" class="form-control"></td>
      </tr>
      <tr>
        <td><label><b>Email:</b></label></td>
        <td><input type="text"  name="email" required class="form-control"></td>
      </tr>
      <tr>
        <td><label><b>Phân quyền:</b></label></td>
        <td>
          <select class="rule" name="rule" class="form-control" required>
            <option value="">Lựa chọn chức năng</option>
         @if($levels)
         
          @foreach( $levels as $level )
        <option  value="{{$level->id}}">{{$level->rules}}</option>
          @endforeach
        @endif
            </select>
        </td>
      </tr>
      <tr>
        <td><label><b>Khoa:</b></label></td>
        <td><select class="dep" name="dep" required class="form-control">
          <option value="">Lựa chọn khoa phòng</option>
          @if($dep)
          @foreach ($dep as $dep)
          <option value="{{$dep->id}}">{{$dep->department_name}}</option>
          @endforeach
          @endif
            </select></td>
      </tr>
      <tr>
        <td><label for="psw"><b>Mật khẩu:</b></label></td>
        <td><input type="password" name="psw" class="form-control"></td>
      </tr>
      <tr>
        <td><label for="psw-repeat"><b>Nhập lại mật khẩu:</b></label></td>
        <td><input type="password"  name="psw-repeat" class="form-control"></td>
      </tr>
      <tr><td colspan="2" style="text-align: right;"><button type="submit" class="btn ">Lưu</button></div></td></tr>
      </table>
          <div class="canl"><a href="{{route('show.user')}}" style="text-decoration: none;color: white;">Hủy</a></div>         
</form>
</hr>
  </div>

<style>
* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container_add{
  padding: 10px;
  background-color: white;
  margin-left: 10px;
  width: 100%;

}
.form{
  margin-left: 200px;
}

/* Full-width input fields */
input[type=text], input[type=password], .rule,.dep {
  width: 100%;
  padding: 5px;
  margin: 5px 0 10px 0;
  display: inline-block;
  border: none;
  background: #A9F5D0;
}


input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 10px;
  float: left;
  font-size: 13px;
  width: 150%;
}

/* Set a style for the submit button */
.btn {
  width: 350px;
  background-color: green;
  color: white;
  padding: 7px 7px;
  margin: 5px 0;
  margin-left: 230px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
}

.btn:hover {
  opacity: 1;
  color: black;
}
  .canl{
    width: 350px;
    text-align: center;
    background-color: black;
    color: white;
    padding: 7px 7px;
    margin-top: 5px;
    margin-left:250px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    font-size: 20px;
    opacity: 0.6;
  }
  .canl:hover{
    opacity: 1;
  }
</style>
@endsection