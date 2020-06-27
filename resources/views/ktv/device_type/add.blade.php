@extends('ktv.index')
@section('content')
<style>
  input[type=text], select[title=dv_group] {
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
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 20px;
  }
  .canl{
    width: 100%;
    background-color: black;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 20px;
    text-align: center;
  }
  .btn:hover {
    background-color: #45a049;
    color: black;

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
<div style="font-size: 25px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Nhập thông tin loại thiết bị</div>
<hr >
<div class="editKtv">
  <form action="{{ route('dvtype.postAdd') }}" method="post">
    @csrf
    <table>
      <tr>
        <td width="50%"><label>Loại thiết bị</label></td>
        <td><input type="text"  name="nameDvt" placeholder="Nhập tên loại thiết bị"><br></td>
      </tr>
      <tr>
        <td width="50%"><label>Mã loại thiết bị</label></td>
        <td><input type="text"  name="idDvt" placeholder="Nhập mã loại thiết bị"><br></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input class="btn" type="submit" value="Lưu loại thiết bị" ></input>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <div class="canl" ><a href="{{route('dvtype.show')}}" style="color: white; text-decoration: none;">Hủy bỏ</a></div>
        </td>
      </tr>
    </table> 
    
  </form>
</div>
@endsection
