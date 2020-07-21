@extends('views.header_main')
@section('content')
<!-- -->
<div>
  <h1 >Sửa thông tin khoa phòng</h1>
</div>
 <div class="container">
  <div style="padding: 5px; margin-left: 150px; width: 47%;height: 2%; font-size: 14px;">
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
<form action="{{route('post.dep',['id'=>$dep->id])}}" method="post" class="form">
  @csrf
    <table border="0">
      <tr>
        <td width="30%">
          <label for="email"><b>Tên khoa phòng</b></label>
        </td>
        <td>
           <input type="text"  name="depName"  value="{{$dep->department_name}}" class="form-control">
        </td>
      </tr>
      <tr>
        <td><label for="email"><b>Địa chỉ</b></label></td>
        <td> <input type="text"  name="address" value="{{$dep->address}}" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;">
          <button type="submit" class="btn">Lưu</button>
        </td>
      </tr>
    </table>
     <div class="canl"><a style="text-decoration: none; color: white;" href="{{route('show.department')}}" >Hủy</a></div>
    <br>
</form>
</hr>
  </div>
<style>
* {
  box-sizing: border-box;
}
.btn {
  width: 300px;
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
    width: 300px;
    text-align: center;
    background-color: black;
    color: white;
    padding: 7px 7px;
    margin-top: 5px;
    margin-left:360px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    font-size: 20px;
    opacity: 0.6;
  }
  .canl:hover{
    opacity: 1;
  }

/* Add padding to containers */
.container {
  padding: 30px;
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
  height: 50px;
}
label,a, .registerbtn{
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
  width: 150%;
}

/* Set a style for the submit button */
.registerbtn {
  background-color:#2EFE64 ;
  color: white;
  padding: 7px 5px;
  margin: 3px 0;
  border: none;
  cursor: pointer;
  width: 20%;
  
}
.registerbtn:hover {
  opacity: 1;
  background-color: #4CAF50;
}
</style>
@endsection