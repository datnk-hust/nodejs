@extends('ktv.index')
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
.fa-pencil-square-o:hover{
    border-radius: 4px;
    background-color: yellow;
  }
  .fa-history:hover{
    border-radius: 4px;
    color: red;
  }
</style>
<h2>Danh Sách Thiết Bị Đã Bàn Giao</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td width="25%">
            <input style="width: 90%;" type="text" class="form-control" placeholder="Tên thiết bị" name="dv_name" value="{{request()->dv_name}}">
          </td>
          <td width="25%">
            <select class="form-control" name="dvt_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Mọi loại thiết bị</option>
              @if(isset($dvts))
              @foreach($dvts as $rows)
              <option value="{{ $rows->id }}" >
                {{ $rows->dv_type_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="25%">
            <select class="form-control" name="department_id" style="background-color: #D8D8D8; width: 90%"  >
              <option value="">Mọi khoa</option>
              @if(isset($depts))
              @foreach($depts as $row)
              <option value="{{ $row->id }}" >
                {{ $row->department_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="20%">
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;margin-left: 10px"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td style="text-align: left;font-size: 18px;">Tất cả: {{$devices->total()}}</td>
        </tr>
        <tr>
          <td colspan="5"><br></td>
        </tr>
        <tr>
          <td width="25%"> 
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
          </td>
          <td>
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
          </td>
          <td colspan="2">
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập tên dự án gói thầu" name="import_id" value="{{request()->import_id}}">
          </td>
          <td></td>
        </tr>
      </table>  
    </form>
  </div>
  <br><br><br><br><br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Khoa phòng</th>
        <th>Năm SX</th>
        <th>Ngày bàn giao</th>
        <th width="10%"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $device)
      <tr style="font-size: 15px;">
        <td>{{$device->dv_id}}</td>
        <td>{{$device->dv_name}}</td>
        <td>{{$device->dv_model}}</td>
        <td>{{$device->dv_serial}}</td>
        <td>{{$device->department->department_name}}</td>
        <td>{{$device->produce_date}}</td>
        <td>{{$device->handover_date}}</td>
        <td style="text-align: center;">
          
          <a href="{{route('device.getEdit',['id'=>$device->id])}}"><i class="fa fa-pencil-square-o " title="Xem thông tin" style="font-size: 18px" aria-hidden="true"></i></a>
          <a href="{{route('device.history',['id'=>$device->id])}}"><i class="fa fa-history " style="font-size: 18px" title="Lịc sử TB" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$devices->links()}}
    </nav>
  </div>
</div>

@endsection
