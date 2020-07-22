@extends('header_main')
@section('content')
<style type="text/css">
  input[type=text] {
    padding-left: 3px;
    font-size: 20px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 20px;
    margin-top: 30px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
 
</style>

<h2>Thống kê lịch sử sửa chữa thiết bị</h2>
<div class="container2">
  <div>
   <table width="95%" border="0">
     <tr >
       <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Tên thiết bị</label></td>
       <td width="35%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 20px;height: 90%">{{$device->dv_name}}</label></td>
       <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Hãng sản xuất</label></td>
       <td colspan="1"> 
        <label class="form-control" style="background-color: #D8D8D8; width: 95%;font-size: 20px;height: 90%">{{$device->manufacturer}}</label>
      </td>
      <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Xuất xứ</label></td>
      <td> 
        <label class="form-control" style="background-color: #D8D8D8; width: 100%;font-size: 20px;height: 90%">{{$device->country}}</label>
      </td>
     </tr>
     <tr>
       <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Loại thiết bị</label></td>
        <td ><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 20px;height: 90%">{{$device->dv_type->dv_type_name}}</label></td>
        <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Ngày nhập</label></td>
        <td 20%><label class="form-control" style="background-color: #D8D8D8; width: 95%;font-size: 18px;height: 90%">{{$device->import_date}}</label></td>
        <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Năm sản xuất</label></td>
        <td 20%><label class="form-control" style="background-color: #D8D8D8; width: 100%;font-size: 18px;height: 90%">{{$device->produce_date}}</label></td>
     </tr>
     <tr>
       <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Nhóm thiết bị</label></td>
        <td ><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 20px;height: 90%">{{$device->group}}</label></td>
        <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Serial</label></td>
        <td 20%><label class="form-control" style="background-color: #D8D8D8; width: 95%;font-size: 18px;height: 90%">{{$device->dv_serial}}</label></td>
        <td width="12%"><label class="form-control" style="background-color: #D8D8D8; width: 97%;font-size: 18px;height: 90%;">Model</label></td>
        <td 20%><label class="form-control" style="background-color: #D8D8D8; width: 100%;font-size: 18px;height: 90%">{{$device->dv_model}}</label></td>
     </tr>
   </table>
  </div>
  <br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>STT</th>
        <th>Ngày sự cố</th>
        <th>Ngày xử lý</th>
        <th>Đơn vị sửa</th>
        <th>Ghi chú</th>
        <th width="15%">Tình trạng sử dụng</th>
<!--         <th width="10%">Điều khiển</th>
 -->      </tr>
    </thead>
    <tbody>
      <?php $i=1 ?>
      @foreach($his as $row)
      <tr style="font-size: 15px;">
        <td>{{$i++}}</td>
        <td>{{$row->schedule_date}}</td>
        <td>{{$row->proceed_date}}</td>
        <td>{{$row->repair_responsible}}</td>
        <td>{{$row->note}}</td>
        @if($row->status == 0)
        <td>Đang sửa chữa</td>
        @elseif($row->status == 1)
        <td>Đã sửa và sử dụng tốt</td>
        @else
        <td>Đã hỏng ngưng sử dụng</td>
        @endif
<!--         <td></td>
 -->      </tr>
      @endforeach
    </tbody>
  </table>
  </div>

@endsection
