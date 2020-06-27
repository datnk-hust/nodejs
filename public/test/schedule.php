@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding: 3px;
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
.fa-refresh:hover{
    border-radius: 4px;
    background-color: yellow;
    cursor: pointer;
  }
  .fa-pencil:hover{
    border-radius: 4px;
    color: red;
  }
  .edit,.ban_giao{
    cursor: pointer;
  }
  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    top: 300px;
    bottom: 200px;
    left: 500px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    height: 230px;
    border-radius: 5px;
  }
  .form-container1{
    width: 600px;
    padding: 10px;
    background-color: #BDBDBD;
    height: 320px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text],.form-container select[type=text],.form-container1 input[type=text],.form-container1 input[type=date]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
    font-size: 18px;
  }
 
  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,.form-container select[type=text]:focus,.form-container1 input[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn, .form-container1 .btn {
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
  .form-container .cancel, .form-container1 .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover, .form-container1 .btn:hover, .open-button:hover {
    opacity: 1;
  }
</style>
<h2>Lịch sửa chữa thiết bị</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      <table width="100%" border="0">
        <tr>
          <td width="25%">
            <input style="width: 300px;" type="text" class="form-control" placeholder="Tên thiết bị" name="dv_name" value="{{request()->dv_name}}">
          </td>
          <td width="25%">
            <input style="width: 300px;" type="text" class="form-control" placeholder="Đơn vị sửa chữa" name="name_repair" value="{{request()->name_repair}}">
          </td>
          <td width="25%">
            <input style="width: 300px;" type="date" class="form-control" placeholder="Ngày đặt lịch sửa chữa" name="schedule_date" value="{{request()->schedule_date}}">
          </td>
          <td width="20%">
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td style="text-align: left;font-size: 18px;">Tất cả: {{$schedules->total()}}</td>
        </tr>
      </table>  
    </form>
  </div>
  <br><br><br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Mã thiết bị</th>
        <th>Model</th>
        <th>Lịch sửa chữa</th>
        <th>Đơn vị sửa</th>
        <th>Thông tin liên hệ</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $row)
      <tr style="font-size: 15px;">
        <td>{{ $row->id}}</td>
        <td>{{ \App\Device::where(['id' => $row->dv_id])->pluck('dv_name')->first()}}</td>
        <td>{{ $row->dv_id}}</td>
        <td>{{ \App\Device::where(['id' => $row->dv_id])->pluck('dv_model')->first()}}</td>
        <td>{{$row->schedule_date}}</td>
        <td>{{$row->repair_responsible}}</td>
        <td>{{$row->information}}</td>
        <td style="text-align: center;">
          <a class="ban_giao" data-deviceid="{{$row->dv_id}}"><i class="fa fa-refresh " title="Cập nhật tình trạng" style="font-size: 18px" aria-hidden="true"></i></a>&nbsp;&nbsp;
          <a class="edit" data-deviceid="{{$row->id}}"><i class="fa fa-pencil " style="font-size: 18px" title="Điều chỉnh" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$schedules->links()}}
    </nav>
  </div>
</div>
<!-- form cập nhật tình trạng sửa chữa -->
<div class="form-popup" id="myForm">
    <form action="{{route('device.updateStatus','id')}}" class="form-container form1" method="post">
      @csrf
      <table>
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 20px;"><b>Cập nhật trạng thái thiết bị</b></label></td>
        </tr>
        <tr><td colspan="2"><hr style="height: 3px;background-color: green;"></td></tr>
        <tr>
          <td colspan="2">
            <select type="text" name="status" style="height: 60px;" class="form-control">
              <option  value="0" >Đã sửa chữa,chuyển về kho đợi bàn giao lại</option>
              <option  value="4">Không thể khắc phục, chuyển vào kho thanh lý</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><button type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn bàn giao thiết bị?')">Lưu
          </button></td>
          <td ><button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
  <!-- form điều chỉnh lịch sửa chữa -->
  <div class="form-popup" id="myForm1">
    <form action="{{route('device.editSchedule', 'id1')}}" class="form-container1 form2" method="post">
      @csrf
      <table width="100%">
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 22px;"><b>Điều chỉnh lịch sửa</b></label></td>
        </tr>
        <tr><td colspan="2"><hr style="height: 2px;background-color: green;margin-top: 10px;"></td></tr>
        <tr>
          <td width="30%" style="font-size: 17px;">Đặt lịch sửa:</td>
          <td><input type="date" name="schedule_date" placeholder="dd/mm/YYYY"  class="form-control" ></td>
        </tr>
         <tr>
          <td style="font-size: 17px;">Đơn vị sửa:</td>
          <td><input type="text" name="name_repair"  class="form-control"></td>
        </tr>
        <tr>
          <td style="font-size: 17px;">Liên hệ :</td>
          <td><input type="text" name="information"  class="form-control"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button type="submit" class="btn">Lưu
          </button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
<script>
 
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
        document.getElementById("myForm1").style.display = "none";

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
$(document).on('click', '.edit', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form2').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form2').attr('action', action.replace('id1',id));
    // Hiện form
    document.getElementById("myForm1").style.display = "block";
  });

</script>
@endsection


<table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Khoa phòng</th>
        <th>Nhà cung cấp</th>
        <th>Hạn sử dụng</th>
        <th>Ngày bàn giao</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $device)
      <tr style="font-size: 15px;">
        <td>{{$device->id}}</td>
        <td>{{$device->dv_name}}</td>
        <td>{{$device->dv_model}}</td>
        <td>{{$device->department->department_name}}</td>
        <td>{{$device->provider->provider_name}}</td>
        <td>{{$device->expire_date}}</td>
        <td>{{$device->handover_date}}</td>
        <td style="text-align: center;">
          <a href="{{route('device.getEdit',['id'=>$device->id])}}"><i class="fa fa-pencil-square-o " title="Sửa" style="font-size: 18px" aria-hidden="true"></i></a>
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('device.del',['id'=>$device->id])}}"><i class="fa fa-trash " style="font-size: 18px" title="Xóa" aria-hidden="true"></i></a>
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
@foreach ($accs as $row)
<input type="checkbox" name="ch1" value="Apple"> Apple
@endforeach
<input type="checkbox" name="ch2" value="Orange"> Orange 
<input type="checkbox" name="ch3" value="Banana"> Banana 


<div class="form-popup" id="myForm">
    <form action="{{route('device.accessory','id')}}" class="form-container form" method="post">
      @csrf
      <div style="font-size: 20px;text-align: center;"><b>Chọn vật tư cho thiết bị</b></div>
      <hr class="hr-pop" style="height: 1px;background-color: green;">
      <table width="100%" border="0" style="margin-top: 10px;">
      <tr>
        <td colspan="2"><select type="text" name="accName" style="height: 40px; padding: 4px;" class="form-control">
          <option>Lựa chọn vật tư</option>
        </select>
      </td>
    </tr>
    <tr>
        <td colspan="2"><span style="font-size: 20px;margin-left: 4px;"><b>Số lượng</b></span><input type="text" name="amountAcc" placeholder="nhập số lượng" style="height: 40px; width: 70%;margin-left: 59px;"></td>
    </tr>
        <tr>
          <td style="text-align: right;"><button  type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn bàn giao thiết bị?')">Lưu
          </button></td>
          <td ><button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
<script type="text/javascript">
 function closeForm() {
        document.getElementById("myForm").style.display = "none";

  }

  $(document).on('click', '.rgt', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
  });
  </script>

  // $(document).on('click', '.rgt', function(){
  //   // Lấy id của data
  //   var id = $(this).attr('data-deviceid');
  //   // Lấy action hiện tại của form theo class
  //   var action = $('.form').attr('action');
  //   // Thay thế id data vào đoạn action của form
  //   var actions= $('.form').attr('action', action.replace('id',id));
  //   // Hiện form
  //   document.getElementById("myForm").style.display = "block";
  // });