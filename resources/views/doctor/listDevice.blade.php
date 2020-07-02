@extends('doctor.dashboard')
@section('content')
<style type="text/css">
  input[type=text]{
    font-size: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    width: 100%;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
  }
  .fa-exclamation-circle{
  	cursor: pointer;
    opacity: 0.7;
  }
  .fa-exclamation-circle:hover{
  	background-color: red;
  		border-radius: 5px;
      opacity: 1

  }
  .fa-pencil-square-o{
    opacity: 0.7;
    cursor: pointer;
  }
  .fa-pencil-square-o:hover{
    opacity: 1;
    background-color: yellow;
    border-radius: 5px;
  }
  
  h2{
    margin-left: 40px;
    font-weight: bold;
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
    max-height: 500px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text], .form-container input[type=password], .form-container input[type=date],.form-container select[type=text] , .form-container textarea {
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
<h2>Danh sách thiết bị của khoa {{$user->department->department_name}}</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0" class="input-group mb-3">
        <tr>
            <td width="25%"><div><input class="form-control" type="text" name="dv_name" placeholder="Nhập tên thiết bị"></div></td>
            <td width="20%"><div style="margin-left: 5px;"><input class="form-control" type="text" name="model" placeholder="Nhập model"></div></td>
            <td width="20%"><div style="margin-left: 5px;"><input class="form-control" type="text" name="serial" placeholder="Nhập serial"></div></td>
            <td width="20%"><div style="margin-left: 5px"><button  class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Tìm kiếm</button></div>
            </td>
            <td><div style="font-size: 20px;text-align: center;">Tổng: {{ $devices->total() }}</div></td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  @if(isset($devices))
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Loại thiết bị</th>
        <th>Ngày bàn giao</th>
        <th width="10%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
        @if(isset($devices))
        @foreach($devices as $row)
      <tr style="font-size: 15px;">
        <td>{{$row->dv_id}}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{ $row->dv_model}}</td>
        <td>{{ $row->dv_serial}}</td>
        <td>{{ \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first() }}</td>
        <td>{{$row->handover_date}}</td>
        <td style="text-align: center;">
          <a href="{{route('doctor.checkDevice',['id'=>$row->id])}}"><i class="fa fa-pencil-square-o " title="Xem thông tin" style="font-size: 25px" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="bao_hong" data-deviceid="{{$row->id}}"><i style="font-size: 25px;" class="fa fa-exclamation-circle " title="Báo hỏng" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$devices->links()}}
    </nav>
  </div>
</div>
<!-- form báo hỏng thiết bị -->
<div class="form-popup" id="myForm">
    <form action="{{ route('doctor.noticeDev', 'id') }}" class="form-container form1" method="post">
      @csrf
      <table style="font-size: 17px;" border="0" width="100%">
        <tr style="display: none;">
          <td></td>
          @if(isset($row))
          <td width="80%"><input type="text" name="dv_id" value="{{$row->id}}" hidden=""></td>
          @else
          <td width="80%"><input type="text" name="dv_id" value="" hidden=""></td>
          @endif
        </tr>
        <tr>
          <td><label>Lý do hỏng</label></td>
          <td><textarea cols="7" rows="2" name="reason" required=""></textarea></td>
        </tr>
        <tr>
          <td><label>Mã người báo hỏng</label></td>
          <td><input type="text" name="user_id" value="{{ Auth::user()->user_id }}"></td>
        </tr>
        <tr>
          <td><label>Người thông báo</label></td>
          <td><input type="text" name="userName" value="{{ Auth::user()->fullname }}"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn báo hỏng thiết bị?')">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
  @endif
<!-- code popup form -->
  <script>
  function openForm() {
    
    // document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  $(document).on('click', '.bao_hong', function(){
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
