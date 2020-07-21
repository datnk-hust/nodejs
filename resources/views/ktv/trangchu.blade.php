@extends('views.header_main')
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
  }
  .btnsearch{
    width: 150px;
    padding: 3px;
    margin-left: 5px;


  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
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
<?php $noticees = DB::table('notification')->where('status','=',0)->orWhere('status','=',2)->orWhere('status','=',16)->orderBy('id','desc')->get() ?>
<div style="margin-left: 50px;font-size: 17px;font-weight: bold;">Chào mừng đến với hệ thống quản lý trang thiết bị y tế BME-HUST</div><br>
<div style="margin-left: 50px;font-size: 20px;font-weight: bold;">Bạn Có <span style="color: red;font-size: 25px;">{{count($noticees)}}</span> Thông Báo Mới!</div>
<div class="container2">
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 18px;">
        <th  width="1%">STT</th>
        <th width="12%">Thời gian</th>
        <th>Nội dung thông báo</th>
        <th>Tên thiết bị</th>
        <th width="10%">Mã TB</th>
        <th>Người gửi</th>
        <th width="7%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody><?php $i=1 ?>
        @foreach($noticees as $notice)
        <tr style="font-size: 15px;color: red;font-weight: bold;">
          <td>{{ $i++}}</td>
        
        <td>{{$notice->req_date}}</td>
        @if($notice->status == 2)
        <td>{{$notice->req_content}} đến {{\App\Department::where(['id'=>$notice->dept_next])->pluck('department_name')->first()}}</td>
        @else
        <td>{{$notice->req_content}}</td>
        @endif
        <td>{{ \App\Device::where(['id' => $notice->dv_id])->pluck('dv_name')->first()}}</td>
        <td>{{ \App\Device::where(['id' => $notice->dv_id])->pluck('dv_id')->first()}}</td>
        <td>{{ \App\User::where(['user_id' => $notice->annunciator_id])->pluck('fullname')->first()}} </td>
        <td style="text-align: center;">
           
          <a href="{{route('ktv.acceptNotice',['user_id'=>Auth::id(),'id'=>$notice->id,'dv_id'=>$notice->dv_id,'status'=>$notice->status]) }}"><i class="fa fa-pencil-square-o " title="Đã xem" aria-hidden="true" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('ktv.delete.notification',['id'=>$notice->id])}}" onclick="return confirm('Bạn có chắc chắn?')" ><i class="fa fa-trash "  title="Xóa" aria-hidden="true" ></i></a>
        </td>
      </tr>
      @endforeach
      @foreach($notices as $notice)

      <tr style="font-size: 15px;">
        <td>{{ $i++}}</td>
        
        <td>{{$notice->req_date}}</td>
        @if($notice->status == 2)
        <td>{{$notice->req_content}} đến {{\App\Department::where(['id'=>$notice->dept_next])->pluck('department_name')->first()}}</td>
        @else
        <td>{{$notice->req_content}}</td>
        @endif
        <td>{{ \App\Device::where(['id' => $notice->dv_id])->pluck('dv_name')->first()}}</td>
        <td>{{ \App\Device::where(['id' => $notice->dv_id])->pluck('dv_id')->first()}}</td>
        <td>{{ \App\User::where(['user_id' => $notice->annunciator_id])->pluck('fullname')->first()}} </td>
        <td style="text-align: center;">
          <a href="{{route('ktv.acceptNotice',['user_id'=>Auth::id(),'id'=>$notice->id,'dv_id'=>$notice->dv_id,'status'=>$notice->status]) }}"><i class="fa fa-pencil-square-o " title="Đã xem" aria-hidden="true" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('ktv.delete.notification',['id'=>$notice->id])}}" onclick="return confirm('Bạn có chắc chắn?')"><i class="fa fa-trash "  title="Xóa" aria-hidden="true"></i></a>
        </td>
      </tr>
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

