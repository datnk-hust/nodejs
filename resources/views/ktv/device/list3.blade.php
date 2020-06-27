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
    width: 600px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 400px;
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
<h2>Danh Sách Thiết Bị Đang Sửa Chữa</h2>
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
           <select class="form-control" name="provider_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Mọi nhà cung cấp</option>
              @if(isset($providers))
              @foreach($providers as $row)
              <option value="{{ $row->id }}" >
                {{ $row->provider_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="25%">
            <select class="form-control" name="department_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Mọi khoa</option>
              @if(isset($departments))
              @foreach($departments as $rows)
              <option value="{{ $rows->id }}" >
                {{ $rows->department_name }}
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
        <tr><td colspan="5"><br></td></tr>
        <tr>
          <td width="25%"> 
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
          </td>
          <td>
            <input style="width: 90%;" type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
          </td>
          <td colspan="3"></td>
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
        <th>Khoa phòng</th>
        <th>Nhà cung cấp</th>
        <th>Ngày nhập</th>
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
        <td>{{$device->department->department_name}}</td>
        <td>{{$device->provider->provider_name}}</td>
        <td>{{$device->import_date}}</td>
        <td>{{$device->handover_date}}</td>
        <td style="text-align: center;">
          <a class="ban_giao" data-deviceid="{{$device->id}}"><i class="fa fa-refresh " title="Cập nhật tình trạng" style="font-size: 18px" aria-hidden="true"></i></a>&nbsp;&nbsp;
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
<!-- form cập nhật tình trạng sửa chữa -->
<div class="form-popup" id="myForm">
    <form action="{{route('device.updateStatus','id')}}" class="form-container form1" method="post">
      @csrf
      <table width="100%" style="font-size: 17px;">
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 20px;"><b>Cập nhật trạng thái thiết bị</b></label></td>
        </tr>
        <tr><td colspan="2"><hr style="height: 3px;background-color: green;"></td></tr>
        <tr>
        	<td>Tình trạng thiết bị</td>
          <td>
            <select type="text" name="status" style="height: 50px;" class="form-control">
              <option  value="0" >Đã sửa chữa,tình trạng sử dụng tốt</option>
              <option  value="4">Không thể khắc phục, chuyển vào kho thanh lý</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Lý do hỏng</td>
          <td><input type="text" name="note"></td>
        </tr>
        <tr>
        	<td>Thời gian cập nhật</td>
        	<td><input type="date" name="update_time" placeholder="dd/mm/YYYY" class="form-control" required></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button style="margin-top: 5px;" type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn bàn giao thiết bị?')">Lưu
          </button>
          <button type="button" style="margin-top: 5px;" class="btn cancel" onclick="closeForm()">Hủy</button></td>
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
</script>
@endsection
