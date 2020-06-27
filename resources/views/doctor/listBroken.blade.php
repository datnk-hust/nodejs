@extends('doctor.dashboard')
@section('content')
<style type="text/css">
  input[type=text]{
    margin-left: : 0px;
    font-size: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    height: 35px;
    width: 600px;
  }

  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
  }
  .fa-exclamation-circle{
  	cursor: pointer;
  }
  .fa-exclamation-circle:hover{
  	background-color: red;
  		border-radius: 5px;

  }
  .fa-medkit{
  	cursor: pointer;
  }
.fa-medkit:hover{
	background-color: green;
	border-radius: 5px;
}
  .form-container input[type=text],.form-container select[type=text]{
    width: 98%;
    padding: 3px;
    margin: 3px;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
    font-size: 18px;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,.form-container select[type=text]:focus {
    background-color: #ddd;
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
  .form-container .cancel{
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover{
    opacity: 1;
  }


.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  margin-left: 40px;
  margin-top: 40px;
}
.form-popup {
    display: none;
    position: fixed;
    top: 200px;
    bottom: 200px;
    left: 200px;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    width: 900px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 700px;
    border-radius: 5px;
  }
  .hr-pop {
    margin: 0;
    padding-top: 2px;
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
</style>
<h2>Danh sách thiết bị báo hỏng {{$user->department->department_name}}</h2>
<div class="container2">
  <div>
    <div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
      @if(session('message'))
      <div class="alert alert-success" style="width: 70%;">
        {{session('message')}}
      </div>
      @endif
    </div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0" class="input-group mb-3">
        <tr>
            <td width="40%"><input type="text"  name="dv_name" placeholder="Nhập tên thiết bị"></td>
            <td width="40%"><div style="margin-left: 10px;"><button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Tìm kiếm</button></div>
            </td>
            <td></td>
            <td></td>
            <td><div style="font-size: 20px;">Tổng: {{ $devices->total() }}</div></td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Loại thiết bị</th>
        <th>Ngày bàn giao</th>
        <th>Ngày báo hỏng</th>
      </tr>
    </thead>
    <tbody>
        @if(isset($devices))
        @foreach($devices as $row)
      <tr style="font-size: 15px;">
        <td>{{$row->id}}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{ $row->dv_model}}</td>
        <td>{{ $row->dv_serial}}</td>
        <td>{{ \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first() }}</td>
        <td>{{$row->handover_date}}</td>
        <td>{{ \App\Notification::where(['dv_id'=>$row->dv_id,'status'=>0])->pluck('req_date')->first() }}</td>
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

<div class="form-popup" id="myForm">
    <form action="{{route('device.accessory','id')}}" class="form-container form" method="post">
      @csrf
      <div style="font-size: 20px;text-align: center;"><b>Danh sách vật tư kèm theo của thiết bị</b></div>
      <hr class="hr-pop" style="height: 1px;background-color: green;">
     <table class="table table-condensed table-bordered table-hover">
     <thead style="background-color: #81BEF7;">
      <tr style="font-size: 17px;">
        <th>Tên vật tư</th>
        <th>Số lượng</th>
        <th>Ngày cấp vật tư</th>
        <th>Ghi chú</th>
      </tr>
     </thead>
     <tbody>
      @if(isset($accs))
      @foreach($accs as $acc)
       <tr style="font-size: 15px;">
        <td>{{\App\Accessory::where(['id' =>$acc->acc_id])->pluck('acc_name')->first() }}</td>
        <td>{{ $acc->amount}} </td>
        <td> {{$acc->export_date}}</td>
        <td>{{ $acc->note}}</td>
      </tr>
      @endforeach
      @endif
      </tbody>
    </table>
    <div style="text-align: center;"><button type="button" class="btn" onclick="closeForm()">Đóng</button></div>
    </form>
  </div>

<script type="text/javascript">
 function closeForm(){
        document.getElementById("myForm").style.display = "none";
  }
function openForm(){
        document.getElementById("myForm").style.display = "block";
}
  </script>
@endsection