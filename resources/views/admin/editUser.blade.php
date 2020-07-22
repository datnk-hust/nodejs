@extends('header_main')
@section('content')
<!-- -->
<div>
  <h1 >Sửa thông tin người dùng</h1>
</div>
 <div class="container">

 	<div style="padding: 5px; margin-left: : 150px; width: 47%;height: 2%; font-size: 14px;">
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
<form action="{{route('post.editUser',['id'=>$user->id])}}" method="post" class="form">
	@csrf
    <table>
      <tr>
        <td width="45%">
          <label for="email"><b>Mã người dùng:</b></label>
        </td>
        <td>
           <input type="text"  name="user_id" value="{{$user->user_id}}" class="form-control" disabled>
        </td>
      </tr>
      <tr>
        <td width="45%">
          <label for="email"><b>Họ và tên:</b></label>
        </td>
        <td>
           <input type="text"  name="fullname" value="{{$user->fullname}}" class="form-control" required>
        </td>
      </tr>
      <tr>
        <td><label for="email"><b>Địa chỉ</b></label></td>
        <td> <input type="text"  name="address" value="{{$user->address}}" class="form-control"></td>
      </tr>
      <tr>
        <td><label for="email"><b>Phone</b></label></td>
        <td> <input type="text"  name="phone" value="{{$user->mobile}}" class="form-control"></td>
      </tr>
      <tr>
        <td><label for="email"><b>Email</b></label></td>
        <td> <input type="text" class="form-control"  name="email" value="{{$user->email}}" disabled style="background-color: #CEF6D8"></td>
      </tr>
      <tr>
        <td><label for="email"><b>Phân quyền</b></label></td>
        <td>
         @if($user->rule=='1')
        <input type="text" name="rule" class="form-control" value="Admin" disabled style="background-color: #CEF6D8">
    @elseif($user->rule=='2') 
      <input type="text" name="rule" class="form-control" value="KTV" disabled style="background-color: #CEF6D8">
    @else
      <input type="text" name="rule" class="form-control" value="Doctor" disabled style="background-color: #CEF6D8">
    @endif</td>
      </tr>
      <tr>
        <td><label for="email"><b>Khoa</b></label></td>
        <td>
         <select class="dep" name="dep" class="form-control">
          <option value="{{$user->department_id}}">{{$user->department->department_name}}</option>
      @if(isset($deps))
      @foreach($deps as $row)
      @if($row->id != $user->department_id)
      <option value="{{$row->id}}">{{$row->department_name}}</option>
      @endif
      @endforeach
      @endif
    </select></td>
      </tr>
      <tr>
        <td><label for="email"><b>Mật khẩu</b></label></td>
        <td><input type="password" class="form-control" name="psw" placeholder="nhập mật khẩu" required></td>
      </tr>
      <tr>
        <td><label for="email"><b>Nhập lại mật khẩu</b></label></td>
        <td> <input type="password" class="form-control"  name="psw-repeat" ></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: right;">
          <button type="submit" class="btn">Lưu</button>
        </td>
      </tr>
    </table>
    <div class="canl"><a style="text-decoration: none; color: white;" href="{{route('show.user')}}" >Hủy</a></div>
    <br>
</form>
</hr>
  </div>
<style>
* {
  box-sizing: border-box;
}


/* Add padding to containers */
.container {
  padding: 15px;
  background-color: white;
  margin-left: 10px;

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
  height: 40px;
  font-size: 18px;
}
label,a,button{
  font-size: 20px;
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
  width: 115%;
}
.btn {
  width: 330px;
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
    width: 330px;
    text-align: center;
    background-color: black;
    color: white;
    padding: 7px 7px;
    margin-top: 5px;
    margin-left:280px;
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