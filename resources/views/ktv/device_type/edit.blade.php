@extends('ktv.index')
@section('content')
<style>
  input[type=text], select[type=text] {
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
    background-color: green;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 20px;
    opacity: 0.6;
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
    opacity: 0.6;
  }
  .btn:hover {
    opacity: 1;
    color: white;

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
<div style="font-size: 25px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Cập nhật thông tin loại thiết bị</div>
<hr >
<div class="editKtv">
  <form action="{{ route('dvtype.postEdit',['id' => $dv_type->id]) }}" method="post">
    @csrf
    <table>
      <tr>
        <td width="50%"><label>Loại thiết bị</label></td>
        <td><input type="text"  name="nameDvt" value="{{ $dv_type->dv_type_name }}"><br></td>
      </tr>
      <tr>
        <td width="50%"><label>Mã loại thiết bị</label></td>
        <td><input type="text"  name="idDvt" value="{{ $dv_type->dv_type_id }}"><br></td>
      </tr>
      <tr>
        <tr>
        <td width="50%"><label>Nhóm thiết bị</label></td>
        <td>
        <select type="text"  name="group">
            <option value="{{ $dv_type->dv_group}}">{{ $dv_type->dv_group}}</option>
            @if($dv_type->dv_group == 'X')
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option> 
            @elseif($dv_type->dv_group == 'A') 
            <option value="X">X</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            @elseif($dv_type->dv_group == 'B') 
            <option value="X">X</option>
            <option value="A">A</option>
            <option value="C">C</option>
            <option value="D">D</option>
            @elseif($dv_type->dv_group == 'C') 
            <option value="X">X</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="D">D</option>
            @elseid($dv_type->dv_group == 'D')
            <option value="X">X</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            @else
            <option value="X">X</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            @endif
          </select></td>
      </tr>  
      <tr>
        <td></td>
        <td>
          <input class="btn" type="submit" value="Cập nhật thông tin" ></input>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
    <div class="canl" style="text-align: center;"><a href="{{route('dvtype.show')}}" style="color: white; text-decoration: none;">Hủy cập nhật loại thiết bị</a></div>
        </td>
      </tr>
    </table> 
  </form>
</div>
@endsection
