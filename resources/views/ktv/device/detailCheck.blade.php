@extends('ktv.index')
@section('content')
<style type="text/css">
	input[type=text], select, input[type=date]{
		padding: 3px;
		margin: 7px;
		font-size: 17px;
		width: 100%;
	}
.btn{
  width: 500px;
  background-color: green;
  color: black;
  padding: 5px;
  margin: 7px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 100px;
}

.btn:hover , .canl:hover{
  opacity: 1;
  color: white;
  font-weight: bold;
}
.canl{
	width: 500px;
  	background-color: black;
  	color: black;
  	padding: 5px;
  	margin: 7px 0;
  	border: none;
  	border-radius: 4px;
  	cursor: pointer;
  	font-size: 20px;
  	opacity: 0.6;
  	 margin-left: 100px;
}
</style>
<div>
	<h1 style="margin-left: 70px;">Cập nhật thông tin bảo dưỡng thiết bị</h1>
	<hr style="background-color: green;height: 1px;width: 95%">
</div>
<div style="margin-left: 150px;"  class="form-group">
    
    <form action="{{ route('device.editcheck',['id'=>$check->id])}}" class="form-container" method="post">
    	@csrf
      <table width="70%" style="font-size: 20px;" border="0" >
        <!-- <tr>
          <td><label>Năm</label></td>
          <td><input type="text" name="year" value="{{$check->year}}" class="form-container" disabled=""></td>
        </tr>
        <tr>
          <td><label>Tháng</label></td>
          <td><input type="text" name="month" value="{{$check->month}}" class="form-container" disabled=""></td>
        </tr> -->
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$check->dv_id}}" class="form-container" disabled=""></td>
        </tr>
        <!-- <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check" name="id_check" class="form-container" value="{{$check->check_id}}" disabled=""></td>
        </tr> -->
        <tr>
          <td  width="20%"><label>Loại kiểm tra</label></td>
          <td>
            <select id="select_check" type="text" class="form-container" name="select_check" style="font-style: 17px;">
              <option value="{{$check->type_check}}">{{$check->type_check}}</option>
              @if($check->type_check == 'C')
              <option value="M">M</option>
              <option value="I">I</option>
              @elseif($check->type_check == 'M')
              <option value="C">C</option>
              <option value="I">I</option>
              @else
              <option value="C">C</option>
              <option value="M">M</option>
              @endif
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" class="form-container" name="date_check" value="{{$check->time}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" class="form-container" name="checker" value="{{$check->checker}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" class="form-container" name="note" value="{{$check->note}}"></td>
        </tr>
        <tr>
        	<td></td>
          	<td style="text-align: center;width: 100%">
          		<div style="text-align: left;"><button type="submit" class="btn btn-primary" >Lưu</button></div>
      		</td>
        </tr>
        <tr>
        	<td></td>
          	<td style="text-align: center;width: 100%">
          		<div class="canl" style="text-align: center;"><a style="color: white; text-decoration: none;" href="{{route('device.maintainCheck',['id'=>$check->dv_id])}}">Hủy</a></div>
      		</td>
        </tr>
        
      </table>
    </form>
  </div>
  @endsection