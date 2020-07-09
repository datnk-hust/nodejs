@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding: 3px;
    font-size: 20px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
  	margin: 20px;
  	margin-top: 60px;
  }
  h2{
  	margin-left: 20px;
  	font-weight: bold;
  }
  
</style>
<h2>Danh Sách Nhà Cung Cấp Trang Thiết Bị</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td><input style="width: 90%;" type="text" class="form-control" placeholder="Tên nhà cung cấp" name="searchName" value="{{request()->searchName}}"></td>
          <td><input style="width: 90%;" type="text" class="form-control" placeholder="Email nhà cung cấp" name="searchEmail" value="{{request()->searchEmail}}"></td>
          <td>
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;margin-left: -2px;"><i class="fa fa-search">&nbsp;Tìm kiếm</i></button>
          </td>
          <td width="5%" style="text-align: left;font-size: 18px;">Tất cả: {{$providers->total()}}</td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Nhà cung cấp</th>
        <th>Địa chỉ</th>
        <th>Người đại diện</th>
        <th>Phone</th>
        <th>Email</th>
        <th width="10%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($providers as $provider)
      <tr style="font-size: 15px;">
        <td>{{$provider->id}}</td>
        <td>{{$provider->provider_name}}</td>
        <td>{{$provider->address}}</td>
        <td>{{$provider->representator}}</td>
        <td>{{$provider->mobile}}</td>
        <td>{{$provider->email}}</td>
        <td style="text-align: center;">
          <a href="{{route('provider.getEdit',['id'=>$provider->id])}}"><i class="fa fa-pencil-square-o " style="font-size: 18px;" title="Sửa" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('provider.del',['id'=>$provider->id])}}"><i class="fa fa-trash" style="font-size: 18px;" title="Xóa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$providers->links()}}
    </nav>
  </div>
</div>

@endsection