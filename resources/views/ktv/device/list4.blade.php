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
.fa-history:hover{
    border-radius: 4px;
    background-color: yellow;
  }
  .fa-truck:hover{
    border-radius: 4px;
    color: red;
  }
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
    max-height: 500px;
    border-radius: 5px;
  }
  .form-container .cancel {
    background-color: red;
  }
</style>
<h2>Danh Sách Thiết Bị Ngưng Sử Dụng</h2>
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
              @foreach($providers as $rv)
              <option value="{{ $rv->id }}" {{ (request()->provider_id == $rv->id) ? 'selected' : "" }}>
                {{ $rv->provider_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="25%">
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
        <th>Mã thiết bị</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Nhà cung cấp</th>
        <th>Ngày bàn giao</th>
        <th>Ngày thu hồi</th>
        <th width="7%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $device)
      <tr style="font-size: 15px;">
        <td>{{$device->dv_id}}</td>
        <td>{{$device->dv_name}}</td>
        <td>{{$device->dv_model}}</td>
        <td>{{$device->dv_serial}}</td>
        <td>{{$device->provider->provider_name}}</td>
        <td>{{$device->handover_date}}</td>
        <td>{{ \App\Maintenance_schedule::where(['dv_id' => $device->id])->where(['status'=>2])->pluck('proceed_date')->first()}}</td>
        <td style="text-align: center;">
          <a href="{{route('device.history',['id'=>$device->id])}}"><i class="fa fa-history " title="Xem vòng đời" style="font-size: 20px" aria-hidden="true"></i></a>&nbsp;&nbsp;
          <a class="sale" data-deviceid="{{$device->id}}"><i class="fa fa-truck " style="font-size: 20px;cursor: pointer;" title="Thanh lý" aria-hidden="true" ></i></a>
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
  <div class="form-popup" id="myForm">
    <form action="{{ route('device.sale', 'id') }}" class="form-container form1" enctype="multipart/form-data" method="post">
      @csrf
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label for="email" style="text-align: center; font-size: 22px;"><b>Thanh lý thiết bị</b></label></td>
        </tr>
        <tr>
          <td colspan="2"><hr style="height: 2px;background-color: green"></td>
        </tr>
        <tr>
          <td>Ngày thanh lý</td>
          <td><input style="margin-left: 3px;" value="{{date('Y-m-d')}}" type="date" name="sale_date" class="form-control"></td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td>Chịu trách nhiệm</td>
          <td><input style="margin-left: 3px;" class="form-control" type="text" name="saler" value="{{Auth::user()->fullname}}"></td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button type="submit" id="luuAnh" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn thanh lý thiết bị?')">Xác nhận
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>

 
<script>
  function openForm() {
    
    // document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  $(document).on('click', '.sale', function(){
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
