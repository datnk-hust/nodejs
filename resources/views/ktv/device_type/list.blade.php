@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text], select[title=dv_group] {
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
<h2>Danh Sách Loại Thiết Bị</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td width="30%"><input style="width: 400px;" type="text" class="form-control" placeholder="Tên loại thiết bị" name="searchName" value="{{request()->searchName}}"></td>
          <td width="30%">
            <select title="dv_group" name="dv_group" class="form-control" style="background-color: #E6E6E6">
              <option value="">Phân loại theo nhóm</option>
              <option value="A">Nhóm A</option>
              <option value="B">Nhóm B</option>
              <option value="C">Nhóm C</option>
              <option value="D">Nhóm D</option>
            </select>  
          </td>
          <td width="30%">
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;margin-left: 30px;"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td width="10%" style="text-align: left;font-size: 18px;">Tất cả: {{$dv_types->total()}}</td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;font-weight: bold;">
        <th>ID</th>
        <th>Tên loại thiết bị</th>
        <th width="10%"></th>
      </tr>
    </thead>
    <tbody>
    	@foreach($dv_types as $dv_type)
      <tr style="font-size: 15px;">
        <td>{{$dv_type->id}}</td>
        <td>{{$dv_type->dv_type_name}}</td>
        <td style="text-align: center;">
          <a href="{{route('dvtype.getEdit',['id'=>$dv_type->id])}}"><i class="fa fa-pencil-square-o " style="font-size: 20px;" title="Sửa" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('dvtype.del',['id'=>$dv_type->id])}}"><i style="font-size: 20px;" class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$dv_types->links()}}
    </nav>
  </div>
</div>
@endsection
