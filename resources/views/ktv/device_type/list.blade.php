@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text], select[type=text] {
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
          <td width="22%"><select style="width: 90%" class="form-control" type="text" name="dv_group">
            <option value="">Chọn nhóm thiết bị</option>  
            <option value="A" {{ (request()->dv_group == 'A') ? 'selected' : "" }}>A</option>
            <option value="B" {{ (request()->dv_group == 'B') ? 'selected' : "" }}>B</option>
            <option value="C" {{ (request()->dv_group == 'C') ? 'selected' : "" }}>C</option>
            <option value="D" {{ (request()->dv_group == 'D') ? 'selected' : "" }}>D</option>
            <option value="X" {{ (request()->dv_group == 'X') ? 'selected' : "" }}>X</option>
          </select>
            </td>
          <td width="22%"><input style="width: 90%;margin-left: 10px;" type="text" class="form-control" placeholder="Mã loại thiết bị" name="searchId" value="{{request()->searchId}}"></td>
          <td width="22%">
            <input style="width: 90%;margin-left: 10px;" type="text" class="form-control" placeholder="Tên loại thiết bị" name="searchName" value="{{request()->searchName}}">
          </td>
          <td width="22%">
            <button class="btn btn-primary" type="submit" style="width: 100px;padding: 4px;margin-left: 30px;"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td width="12%" style="text-align: left;font-size: 18px;">Tất cả: {{$dv_types->total()}}</td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;font-weight: bold;">
        <th>ID</th>
        <th>Mã loại thiết bị</th>
        <th>Tên loại thiết bị</th>
        <th>Nhóm thiết bị</th>
        <th width="10%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <?php $i= 1 ?>
    	@foreach($dv_types as $dv_type)
      <tr style="font-size: 15px;">
        <td>{{$i++}}</td>
        <td>{{$dv_type->dv_type_id}}</td>
        <td>{{$dv_type->dv_type_name}}</td>
        <td>{{$dv_type->dv_group}}</td>
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
