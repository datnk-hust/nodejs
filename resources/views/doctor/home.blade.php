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
    margin-top: 40px;
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
<div style="margin-left: 40px;font-size: 17px;font-weight: bold;">Chào mừng đến với hệ thống quản lý thiết bị tại khoa phòng</div>
<div style="margin-left: 40px;font-size: 17px;font-weight: bold;">Bạn đang có <span style="color: red;font-size: 30px;">{{$notices->total()}}</span> thông báo</div>
<div class="container2">
  <br>
  @if($notices->total() != 0)
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Thời gian</th>
        <th>Nội dung</th>
        <th>Người gửi</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
        @foreach($notices as $notice)
      <tr style="font-size: 15px;">
        <td>{{$notice->id}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>Phòng vật tư</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.acceptNoitce',['id'=>$notice->id, 'user_id'=>Auth::user()->user_id])}}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{ route('doctor.delNoitce',['id'=>$notice->id])}}"><i class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  @endif
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$notices->links()}}
    </nav>
  </div>
</div>
@endsection