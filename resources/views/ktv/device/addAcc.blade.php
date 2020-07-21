@extends('views.header_main')
@section('content')
<style type="text/css">
  label {
  font-size: 20px;
  font-weight: bold;
  padding: 2px;
  background-color: #81DAF5;
  border: solid 0px;
  border-radius: 4px;
  width: 150px;
  text-align: center;
}
  .container2{
    margin: 40px;
    margin-top: 40px;
    font-size: 20px;
  }
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
  hr{
    height: 2px;
    background-color: #2EFE64;
  }
  label {
    font-weight: bold;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-left: 2px;
    padding: 3px;

  }
</style>
<div> 
  <h1 style="margin-left: 5px;">Nhập vật tư kèm theo cho thiết bị {{$dv->dv_name}}</h1>
  <hr>
  <div class="container2">
  <form action="{{route('device.saveAcc',['id'=>$dv->id] )}}" method="post">
         @csrf
    <table border="0" width="100%" >
      <tr>
        <td><label>Tên vật tư<span style="color: red">*</span></label></td>
        <td><input type="text"  name="accName" required></td>
        <td><label>Nhà cung cấp</label></td>
        <td><select type="text" name="provider" >
            <option value="">Nhà cung cấp</option>
            @isset($providers)
            @foreach($providers as $rows)
            <option name="provider" value="{{$rows->id}}">{{$rows->provider_name}}</option>
            @endforeach
            @endif
          </select></td>
      </tr>
       <tr>
        <td><label>Model</label></td>
        <td><input type="text"  name="model" ></td>
        <td><label>Serial</label></td>
        <td><input type="text"  name="serial" ></td>
      </tr>
       <tr>
        <td><label>Loại vật tư<span style="color: red">*</span></label></td>
        <td>
          <select id="sl_dvt" type="text" name="typeAcc" required>
            <option value="">Chọn loại vật tư</option>
            <option value="vtth">Vật tư tiêu hao</option>
            <option value="vttt">Vật tư thay thế</option>
          </select>
        </td>
        <td><label>Năm sản xuất<span style="color: red">*</span></label></td>
        <td><input type="text"  name="produce_date" ></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date" id="import_date" name="import_date" value="{{ date('Y-m-d') }}" ></td>  
        <td><label>Hãng sản xuất</label></td>
        <td><input type="text"  name="produce" ></td>
      </tr>    
       <tr>
        <td><label>Hạn sử dụng</label></td>
        <td><input type="text"  name="expire_date" ></td>
        <td><label>Mã thiết bị đi kèm<span style="color: red">*</span></label></td>
        <td><input type="text" id="dvId"  name="dv_id" value="{{$dv->dv_id}}"></td>
      </tr>
      <tr>
        <td><label>Ghi chú</label></td>
        <td><input type="text"  name="note"></td>
        <td><label>Số lượng</label></td>
        <td><input type="text"  name="accNumber" value="1"></td>
      </tr>
      <tr>
        <td><label>Đơn vị tính</label></td>
        <td><input type="text"  name="unit"></td>
        <td><label>Số lượng dùng</label></td>
        <td><input type="text"  name="used" value="1"></td>
      </tr>
      <tr><td></td>
        <td></td>
        <td></td>
        <td>
          <div>
          <input style="width: 100px; margin-left: 50px;" type="submit" value="Lưu" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="btn btn-danger" style="width: 100px;" href="{{ route('device.show0')}}">Kết thúc</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div>
        </td>
      </tr>
        
    </table> 
  </form>
</div>
</div>
@endsection



