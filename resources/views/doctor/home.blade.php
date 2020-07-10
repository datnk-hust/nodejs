@extends('doctor.dashboard')
@section('content')
<style type="text/css">
  input[type=date]{
    margin-left: : 0px;
    font-size: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    height: 30px;
    width: 200px;
  }
  .btnsearch{
    width: 150px;
    margin-left: 5px;
    margin-top: 0px;
    height: 33px;
    font-size: 17px;


  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 40px;
    margin-top: 20px;
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
<?php $noticees = DB::table('notification')->where('status',5)->orWhere('status',7)->orWhere('status',9)->orWhere('status',13)->orWhere('status',15)->orderBy('id','desc')->get() ?>
<div style="margin-left: 50px;font-size: 20px;"><b>Chào mừng đến {{ \App\Department::where(['id'=>Auth::user()->department_id])->pluck('department_name')->first()}}!</b></div><br>
<div style="margin-left: 50px;font-size: 20px;font-weight: bold;">Danh Sách Thông Báo!</div>
<div class="container2">
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 16px;">
        <th width="1%">STT</th>
        <th width="12%">Thời gian</th>
        <th>Nội dung</th>
        <th>Người gửi</th>
        <th width="8%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <?php $i =1 ?>
      @if($notices->total() != 0)
        @foreach($notices as $notice)
        @if($notice->annunciator_id == Auth::user()->user_id || $notice->receiver == Auth::user()->user_id || $notice->receiver == Auth::user()->department_id)
        <tr style="font-size: 15px;color: red;font-weight: bold;">
        <td>{{$i++}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>Phòng vật tư</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.acceptNotice',['id'=>$notice->id, 'user_id'=>Auth::user()->user_id])}}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{ route('doctor.delNoitce',['id'=>$notice->id])}}"><i class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a>
        </td>
        </tr>
        @endif
        @endforeach
        @endif
        @foreach($noticees as $notice)
        @if($notice->annunciator_id == Auth::user()->user_id || $notice->receiver == Auth::user()->user_id || $notice->receiver == Auth::user()->department_id)
        <tr style="font-size: 15px;">
        <td>{{$i++}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>Phòng vật tư</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.acceptNotice',['id'=>$notice->id, 'user_id'=>Auth::user()->user_id])}}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{ route('doctor.delNoitce',['id'=>$notice->id])}}"><i class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a>
        </td>
        </tr>
        @endif
      @endforeach
      
    </tbody>
  </table>
  
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$notices->links()}}
    </nav>
  </div>
</div>
@endsection