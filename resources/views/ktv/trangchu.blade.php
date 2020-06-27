@extends('ktv.index')
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

<div style="margin-left: 100px;font-size: 17px;font-weight: bold;">Chào mừng đến với hệ thống quản lý trang thiết bị y tế BME-HUST</div>
<div style="margin-left: 100px;font-size: 17px;font-weight: bold;">Bạn đang có <span style="font-size: 35px; color: red;">{{$notices->total()}}</span> thông báo!</div>
 

<div class="container2">
  <br>
  @if($notices->total() != 0)
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 18px;">
        <th width="10%">Mã TB</th>
        <th width="15%">Thời gian</th>
        <th>Nội dung thông báo</th>
        <th>Tên thiết bị</th>
        <th>Người tạo</th>
        <th width="7%"></th>
      </tr>
    </thead>
    <tbody>
        
        @foreach($notices as $notice)
      <tr style="font-size: 15px;">
        <td>{{$notice->dv_id}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>{{ \App\Device::where(['dv_id' => $notice->dv_id])->pluck('dv_name')->first()}}</td>
        <td>{{ \App\User::where(['user_id' => $notice->annunciator_id])->pluck('fullname')->first()}} </td>
        <td style="text-align: center;">
          <a href="{{route('ktv.acceptNotice',['user_id'=>Auth::id(),'id'=>$notice->id,'dv_id'=>$notice->dv_id,'status'=>$notice->status]) }}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn?')"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <!-- <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="#"><i class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a> -->
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

