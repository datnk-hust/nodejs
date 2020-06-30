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
  <h2>Danh sách người dùng</h2><br>
  <div>
    <form action="search" style="float: left;">
      @csrf
      <input type="text" placeholder="Họ tên" name="searchName">
      <input  type="text" placeholder="Email" name="searchEmail">
      <select name="depName" style="padding: 5px;">
        <option >Chọn Khoa</option>
        @if($dep)
        @foreach ($dep as $dep)
        <option name="depName" value="{{$dep->id}}">{{$dep->department_name}}</option>
        @endforeach
        @endif
      </select>
      <button class="btnsearch" type="submit" style="width: 60px;padding: 3px;"><a href=""></a><i class="fa fa-search"></i></a></button>
    </form>
  <div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
  @if(session('message'))
    <div class="alert alert-success" style="width: 70%;float: left;">
      {{session('message')}}
    </div>
  @endif
</div>
<!--   Tổng : {{$users->total()}} người dùng-->
  <div style="width: 250px; padding-top: 0px;padding-bottom: 10px;padding-left: 40px;" class="input-group">
            <span class="input-group-addon">Chọn hiển thị</span>
            <select name="limit" class="form-control" onchange="location = this.value">
              <option selected value="">Lựa chọn</option>
              <option value="{{route('show.user', ['limit' => 5])}}">5</option>
              <option value="{{route('show.user', ['limit' => 6])}}">6</option>
              <option value="{{route('show.user', ['limit' => 50])}}">50</option>
              <option value="{{route('show.user', ['limit' => 100])}}">100</option>
            </select>
  </div>
  </div>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead>
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Phone</th>
        <th>Khoa</th>
        <th>Tùy chọn</th>
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
          <a href="{{route('edit.user',['id'=>$user->id])}}"><i class="material-icons" style="cursor: pointer;">mode_edit</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('del.user',['id'=>$user->id])}}"><i class="material-icons" style="color: red; cursor: pointer;">delete_sweep</i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
</div>
@endsection