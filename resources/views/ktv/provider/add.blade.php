@extends('header_main')
@section('content')
<style>
input[type=text], input[type=email] {
  width: 520px;
  padding: 10px 10px;
  margin: 8px 0;
  margin-left: 50px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}

.btn {
  width: 520px;
  background-color: #4CAF50;
  color: white;
  padding: 10px 12px;
  margin: 5px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
}

.btn:hover {
  background-color: #45a049;
  color: black;

}
.canl{
  position: absolute;
    width: 520px;
    text-align: center;
    background-color: black;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    margin-left:353px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    font-size: 20px;
    opacity: 0.6;
  }
  .canl:hover{
    opacity: 1;
  }
.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 300px;
  padding-top: 20px;
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
  font-weight: bold;
}
</style>
<div style="font-size: 25px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Nhập thông tin nhà cung cấp</div>
<hr >
	
<div class="editKtv">
  <form action="{{route('provider.postAdd')}}" method="post">
  	     @csrf
    <table border="0">
      <tr>
        <td width="50%"><label>Nhà cung cấp</label></td>
        <td><input type="text"  name="nameProvider" ><br></td>
      </tr>
       <tr>
        <td><label>Địa chỉ</label></td>
        <td><input type="text"  name="address" ><br></td>
      </tr> 
      <tr>
        <td><label>Người đại diện</label></td>
        <td><input type="text"  name="representator" ><br></td>
      </tr>
       <tr>
        <td><label>Số điện thoại liên hệ</label></td>
        <td><input type="text"  name="phone" ><br></td>
      </tr>
       <tr>
        <td><label>Email liên hệ</label></td>
        <td><input type="email"  name="email" ><br></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input class="btn" type="submit" value="Lưu" style="margin-left: 50px" ></input>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
        <div class="canl" style="margin-left: 50px"><a href="{{route('show.provider')}}" style="color: white; text-decoration: none;">Hủy</a></div>
        </td>
      </tr>
    </table> 

  </form>
</div>
@endsection
