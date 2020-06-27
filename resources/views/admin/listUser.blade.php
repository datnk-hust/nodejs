@extends('admin.master')
@section('content')
<!--page content-->
<style type="text/css">
  input[type=text], select[name=depName] {
    padding: 3px;
    font-size: 17px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
</style>
<div class="container">
  <h2>Danh sách người dùng</h2>
  @if(isset($message))
  <div class="alert alert-success" style="width: 70%;">
    {{ $message }}
  </div>
  @endif
  <br>
  <div>
    <div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
      @if(session('message'))
      <div class="alert alert-success" style="width: 70%;float: left;">
        {{session('message')}}
      </div>
      @endif
    </div>
    <form action="" method="get">
      {{ csrf_field() }}
      <table width="100%" border="0">
        <tr>
          <td style="float: left;"><input style="width: 300px;" type="text" class="form-control" placeholder="Họ tên" name="searchName" value="{{request()->searchName}}"></td>
          <td style="float: left;">
            <input style="width: 300px;" type="text" class="form-control" placeholder="Email" name="searchEmail" value="{{request()->searchEmail}}">
          </td>
          <td style="float: left;">
            <button class="btnsearch" type="submit" style="width: 100px;margin-left: 10px;padding: 3px"><i class="fa fa-search"></i></button>
          </td>
          <td>
             <div style="width: 250px; padding-top: 0px;padding-bottom: 10px;padding-left: 30px; float: left;" class="input-group">
      <span class="input-group-addon">Chọn hiển thị</span>
      <select name="limit" class="form-control" onchange="location = this.value">
        <option selected value="">Lựa chọn</option>
        <option value="{{route('show.user', ['limit' => 10])}}">10</option>
        <option value="{{route('show.user', ['limit' => 20])}}">20</option>
        <option value="{{route('show.user', ['limit' => 50])}}">50</option>
        <option value="{{route('show.user', ['limit' => 100])}}">100</option>
      </select>
    </div>
          </td>
        </tr>
      </table>  
    </form>
  </div>
  
  <table class="table table-condensed table-bordered table-hover"  style="width: 100%;margin-right: 350px;">
    <thead>
      <tr style="font-size: 20px;width: 100%">
        <th>ID</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Phone</th>
        <th>Khoa</th>
        <th></th>
      </tr>
    </thead>
    <tbody style="font-size: 17px;">
    	@foreach($users as $user)
      <tr style="font-size: 15px;">
        <td>{{$user->id}}</td>
        <td>{{$user->fullname}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->address}}</td>
        <td>{{$user->mobile}}</td>
        <td>{{$user->department_id}}</td>
        <td style="text-align: center;">
          <a  href="{{route('edit.user',['id'=>$user->id])}}"><i class="material-icons" style="cursor: pointer;">mode_edit</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('del.user',['id'=>$user->id])}}" onclick="return confirm('Bạn có chắc chắn xóa?')"><i class="material-icons" style="color: red; cursor: pointer;">delete_sweep</i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{ $users->links()}}
    </nav>
  </div>
</div>
@endsection