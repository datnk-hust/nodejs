@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding: 3px;
    font-size: 17px;
    border: #A4A4A4 solid 1px;
  }
  
  .container2{
    margin: 20px;
    margin-top: 30px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
  .fa-wrench:hover{
    border-radius: 4px;
    cursor: pointer;
  }
  .fa-pencil-square-o:hover{
    border-radius: 4px;
    background-color: yellow;
  }
  .fa-trash:hover{
    border-radius: 4px;
    color: red;
  }

  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    top: 250px;
    bottom: 200px;
    left: 400px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    width: 600px;
    padding: 10px;
    background-color: #BDBDBD;
    height: 370px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text], .form-container input[type=password], .form-container input[type=date] {
    width: 100%;
    padding: 10px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus, .form-container input[type=password]:focus,.form-container select[type=text]:focus {
    background-color: #F2FBEF;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn {
    background-color: #4CAF50;
    font-size: 20px;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 150px;
    margin-left:10px;
    opacity: 0.7;
  }

  /* Add a red background color to the cancel button */
  .form-container .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }
</style>
<h2>Danh Sách Thiết Bị Đang Báo Hỏng</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      <table width="100%" border="0">
        <tr>
          <td width="25%">
            <input style="width: 90%;" type="text" class="form-control" placeholder="Tên thiết bị" name="dv_name" value="{{request()->dv_name}}">
          </td>
          <td width="30%">
            <select class="form-control" name="department_id" style="background-color: #D8D8D8;width: 90%">
             <option value="">Mọi khoa</option>
              @if(isset($depts))
              @foreach($depts as $row)
              <option value="{{ $row->id }}" {{ (request()->department_id == $row->id) ? 'selected' : "" }}>
                {{ $row->department_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="30%">
            <select class="form-control" name="dv_type_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Tất cả loại thiết bị</option>
              @if(isset($dv_types))
              @foreach($dv_types as $rows)
              <option value="{{ $rows->id }}" {{ (request()->dv_type_id == $rows->id) ? 'selected' : "" }}> {{ $rows->dv_type_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="7%">
            <button class="btn btn-primary" type="submit" style="width: 100px;padding: 4px;"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td  style="text-align: center;font-size: 18px;">Tất cả: {{$devices->total()}}</td>
        </tr>
        <tr>
          <td colspan="5"><br></td>
        </tr>
        <tr>
          <td> 
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
          </td>
          <td>
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
          </td>
          <td colspan="2">
            <input style="width: 72%;" type="text" class="form-control" placeholder="Nhập tên dự án gói thầu" name="import_id" value="{{request()->import_id}}">
          </td>
          <td></td>
        </tr>
      </table>  
    </form>
  </div>

  <br><br><br><br><br>

  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 17px;">
        <th>Mã thiết bị</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Khoa phòng</th>
        <th>Nhà cung cấp</th>
        <th>Năm SX</th>
        <th>Ngày nhập</th>
        <th width="10%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $device)
      <tr style="font-size: 15px;">
        <td>{{$device->dv_id}}</td>
        <td>{{$device->dv_name}}</td>
        <td>{{$device->dv_model}}</td>
        <td>{{$device->department->department_name}}</td>

        @if($device->provider_id != '')
        <td>{{$device->provider->provider_name}}</td>
        @else
        <td></td>
        @endif
        <td>{{$device->produce_date}}</td>
        <td>{{$device->import_date}}</td>
        <td style="text-align: center;">
          <a class="ban_giao" data-deviceid="{{$device->id}}"><i class="fa fa-wrench" style="font-size: 18px;" title="Tạo lịch sửa chữa" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
          <a href="{{route('device.getEdit',['id'=>$device->id])}}"><i class="fa fa-pencil-square-o" style="font-size: 18px;" title="Thông tin" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
          <a href="{{route('device.history',['id'=>$device->id])}}"><i class="fa fa-history " style="font-size: 18px" title="Lịch sử sửa chữa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="form-popup" id="myForm">
    <form action="{{ route('device.scheduleRepair', 'id') }}" class="form-container form1" method="post">
      @csrf
      <table width="100%">
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 22px;"><b>Đăng ký lịch sửa chữa</b></label></td>
        </tr>
        <tr>
          <td colspan="2">
            <hr style="height: 5px;
            background-color: green;">
          </td>
        </tr>
        <tr>
          <td width="30%" style="font-size: 17px;font-weight: bold;">Thời gian</td>
          <td><input type="date" value="{{date('Y-m-d')}}" name="fix_date"  style="border-radius: 6px; height: 45px;" ></td>
        </tr>
        <tr>
          <td style="font-size: 17px;font-weight: bold;">Đơn vị sửa chữa</td>
          <td><input type="text" name="name_repair" style="border-radius: 6px;" required></td>
        </tr>
         <tr>
          <td style="font-size: 17px;font-weight: bold;">Thông tin liên hệ</td>
          <td><input type="text" name="infor_repair" style="border-radius: 6px;" required></td>
        </tr>
        <tr>
          <td style="text-align: center;" colspan="2"><button type="submit" class="btn">Tạo lịch</button>
          <button style="margin-left: 7px;" type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>

  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$devices->links()}}
    </nav>
  </div>
</div>
<script>
  function openForm() {
    
    // document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  $(document).on('click', '.ban_giao', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form1').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form1').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
  });

</script>
@endsection

