@extends('header_main')
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
  <h2>Danh sách khoa phòng</h2><br>
  <div>
    <div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
      @if(session('message'))
      <div class="alert alert-success" style="width: 70%;">
        {{session('message')}}
      </div>
      @endif
    </div>
    <form action="" method="get" style="float: left;">
      {{ csrf_field() }}
      <table width="100%" border="0">
        <tr>
          <td><input style="width: 500px;" type="text" class="form-control" placeholder="Tên khoa" name="searchName" value="{{request()->searchName}}"></td>
          <td>
            <button class="btnsearch" type="submit" style="width: 100px;padding: 3px;margin-left: 10px;"><i class="fa fa-search"></i></button>
          </td>
        </tr>
      </table>  
    </form>
    <div style="width: 300px; padding-top: 0px;padding-bottom: 10px;padding-left: 30px; float: left;" class="input-group">
      <span class="input-group-addon">Chọn hiển thị</span>
      <select name="limit" class="form-control" onchange="location = this.value">
        <option selected value="">Lựa chọn</option>
        <option value="{{route('show.department', ['limit' => 10])}}">10</option>
        <option value="{{route('show.department', ['limit' => 20])}}">20</option>
        <option value="{{route('show.department', ['limit' => 50])}}">50</option>
        <option value="{{route('show.department', ['limit' => 100])}}">100</option>
      </select>
    </div>
  </div>
  <div>
  <table class="table table-condensed table-bordered table-hover" border="1" style="width: 100%;margin-right: 350px;">
    <thead>
      <tr style="font-size: 20px;width: 100%" >
        <th width="5%">ID</th>
        <th width="40%">Khoa - Phòng</th>
        <th width="45%">Địa chỉ</th>
        <th>Tùy chọn</th>
      </tr>
    </thead>
    <tbody style="font-size: 17px;">
      @if(isset($deps))
    	@foreach($deps as $dep)
      <tr style="font-size: 15px;">
        <td>{{$dep->id}}</td>
        <td>{{$dep->department_name}}</td>
        <td>{{$dep->address}}</td>
        <td style="text-align: center;">
          <a href="{{route('edit.dep',['id'=>$dep->id])}}"><i title="Sửa" class="material-icons" style="cursor: pointer;">mode_edit</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('del.dep',['id'=>$dep->id])}}" onclick="return confirm('Bạn có chắc chắn xóa?')"><i title="Xóa" class="material-icons" style="color: red; cursor: pointer;">delete_sweep</i></a>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table> 
</div>
    <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$deps->links()}}
    </nav>
  </div>
</div>
@endsection