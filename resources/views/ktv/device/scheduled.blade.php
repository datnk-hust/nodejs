@extends('ktv.index')
@section('content')
<style type="text/css">
  h2{
    margin-left: 40px;
    font-weight: bold;
  }
  hr{
  	height: 2px;
  	background-color: green;
  	margin-left: 40px;
  }
  #sl_dv{
  	width: 500px;
  	
  }
  .form{
  	margin-left: 40px;
  	font-size: 20px;
  }
</style>

<div class="container2">
	<h2>Tạo Quy Trình Bảo Dưỡng Cho Thiết Bị</h2>
	<hr>
	
 	<form class="form" action="{{ route('device.postScheduleAct')}}" method="post">
 		@csrf
 		<div>
    <select name="sl_dv" id="sl_dv" class="form-control" required="">
      @foreach($device as $dv)
      <option value="{{$dv->dv_id}}">{{$dv->dv_name}}</option>
      @endforeach
    </select>
  </div><br>
  	<div class="form-group">
    <label>Hoạt động bảo dưỡng</label>
    <input style="width: 90%" type="text" name="nameAct" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập hoạt động cần bảo dưỡng" required="">
    <small id="emailHelp" class="form-text text-muted">VD: Kiểm tra buồng kính chiếu tia X</small>
  	</div>
  	<div class="form-group">
    <label for="exampleInputPassword1">Tần suất thực hiện</label><br>
    <select style="width: 90%;float: left;" type="text" name="timeAct" class="form-control" placeholder="nhập số ngày" required="">
      <option value="hàng ngày">Hàng ngày</option>
      <option value="1 tuần">1 tuần</option>
      <option value="2 tuần">2 tuần</option>
      <option value="3 tuần"> 3 tuần</option>
      <option value="1 tháng">1 tháng</option>
      <option value="2 tháng"> 2 tháng</option>
      <option value="3 tháng"> 3 tháng</option>
      <option value="4 tháng">4 tháng</option>
      <option value="5 tháng">5 tháng</option>
      <option value="6 tháng">6 tháng</option>
      <option value="7 tháng">7 tháng</option>
      <option value="8 tháng">8 tháng</option>
      <option value="9 tháng">9 tháng</option>
      <option value="10 tháng">10 tháng</option>
      <option value="11 tháng">11 tháng</option>
      <option value="1 năm">1 năm</option>
      <option value="2 năm">2 năm</option>
    </select>
  	</div>
    <div class="form-group">
      <label >Ngày bắt đầu bảo dưỡng</label>
      <input style="width: 90%" type="date" name="datebd" class="form-control" >
    </div>
  	<div class="form-group">
    	<label for="exampleInputEmail1">Ghi chú</label>
    	<input style="width: 90%" type="text" name="note" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  	</div>
  		<div>
      <button style="width: 70px; float: left;" id="luu" type="submit" class="btn btn-primary">Lưu</button>
      <div style="float: left;margin-left: 10px;"><a class="btn btn-primary" href="{{route('device.schedule')}}">Hoàn tất</a></div>
    </div>
	</form>
<br><br><br><br>
	<div style="margin-left: 50px;">
	<table class="table table-condensed table-bordered table-hover" width="90%">
		<thead>
      <th>ID</th>
			<th>Hạng mục công việc</th>
			<th>Tần suất bảo dưỡng</th>
      <th>Ngày bắt đầu bảo dưỡng</th>
			<th>Ghi chú</th>
			<th>Tùy chọn</th>
		</thead>
		<tbody>
      @if(isset($schedules))
			@foreach($schedules as $row)
			<tr>
        <td>{{$row->act_id}}</td>
				<td>{{$row->scheduleAct}}</td>
				<td>{{$row->scheduleTime}}</td>
        <td>{{ $row->startDate}}</td>
				<td>{{$row->note}}</td>
				<td>
            <a href="{{route('device.getEditAct',['id'=>$row->id])}}"><i class="fa fa-pencil-square-o " title="Sửa" style="font-size: 18px" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
           <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('device.delScheduleAct',['id'=>$row->id] )}}" ><i class="fa fa-trash" title="Xóa" aria-hidden="true" style="font-size: 18px"></i></a>    
        </td>
			</tr>
			@endforeach
      @endif
		</tbody>
		
	</table>
</div>
</div>

@endsection



