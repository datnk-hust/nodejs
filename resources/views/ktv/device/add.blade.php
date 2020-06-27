@extends('ktv.index')
@section('content')
<style>
input[type=text], input[type=date]{
  width: 450px;
  padding: 3px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}
select[type=text]{
  width: 450px;
  padding: 5px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
  background-color: #D8D8D8;
}
.btn{
  width: 130px;
  background-color: green;
  color: black;
  padding: 7px;
  margin: 7px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 5px;
}

.btn:hover {
  opacity: 1;
  color: black;
  font-weight: bold;
}
.rgt1{
  margin-top: 10px;
  width: 130px;
  background-color: #848484;
  height: 40px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 5px;
  text-align: center;
  padding: 5px;
}

.rgt1:hover{
  opacity: 1;
}


.rgt_canl:hover{
  opacity: 1;
  text-decoration: none;
  padding: 4px;
  color: black;
}
.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  margin-left: 40px;
  margin-top: 40px;
}
hr {
	background-color: #4CAF50;
	height: 2px;
	padding: 1px;
	margin-left:  50px;
	margin-right: 50px;
}
label {
	font-size: 20px;
  font-weight: bold;
  padding: 2px;
  background-color: #81DAF5;
  border: solid 0px;
  border-radius: 4px;
  width: 150px;
  text-align: center;
}
</style>
<div style="font-size: 30px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Nhập thông tin thiết bị</div>
<hr >
<div class="editKtv">
  <form action="{{route('device.postAdd')}}" method="post">
  	     @csrf
    <table border="0" width="100%" >
      <tr>
        <td><label>Tên thiết bị</label></td>
        <td><input type="text"  name="name_device" required></td>
        <td><label>Nhà cung cấp</label></td>
        <td><select type="text" name="provider" required>
        		<option value="">Nhà cung cấp</option>
        		@isset($providers)
        		@foreach($providers as $rows)
        		<option name="provider" value="{{$rows->id}}">{{$rows->provider_name}}</option>
        		@endforeach
        		@endif
        	</select></td>
      </tr>
       <tr>
        <td><label>Model</label></td>
        <td><input type="text"  name="model" required></td>
        <td><label>Serial</label></td>
        <td><input type="text"  name="serial" ></td>
      </tr>
       <tr>
        <td><label>Loại thiết bị</label></td>
        <td>
        	<select id="searchDvt" type="text" name="device_type" required>
        		<option value="">Loại thiết bị</option>
        		@isset($dv_types)
        		@foreach($dv_types as $rows)
        		<option value="{{$rows->dv_type_id}}">{{$rows->dv_type_name}}</option>
        		@endforeach
        		@endif
        	</select>
        </td>
          <td><label>Nhóm thiết bị</label></td>
        <td>
            <select type="text" id="group" name="group" required="">
              <option value="X">X</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
        </td>
      </tr>
       <tr>
        <td><label>Năm sản xuất</label></td>
        <td><input type="text"  name="produce_date" required=""></td>  
        
        <td><label>Hãng sản xuất</label></td>
        <td><input type="text"  name="produce" required=""></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date" id="import_date" name="import_date" value="{{ date('Y-m-d') }}" ></td>
        <td><label style="font-size: 18px;">Dự án thầu</label></td>
        <td><input type="text"  name="import_id" ></td>
      </tr>
      <tr>
        <td><label>Giá nhập</label></td>
        <td><input type="text"  name="price" ></td>
        <td><label>Xuất xứ</label></td>
        <td><input type="text"  name="country" required=""></td>
      </tr>
      <tr>
        <td><label>Số lưu hành</label></td>
        <td><input type="text"  name="license_number" ></td>
        <td><label style="font-size: 18px;">Ngày cấp SLH</label></td>
        <td><input type="date"  name="license_number_date" ></td>
      </tr>
       <tr>
        <td><label>Bảo dưỡng ĐK</label></td>
        <td>
            <select type="text"  name="maintain_date">
              <option disabled="" value=""></option>
              <option value="hàng ngày">hàng ngày</option>
              <option value="1 tuần">1 tuần</option>
              <option value="1 tháng">1 tháng</option>
              <option value="2 tháng">2 tháng</option>
              <option value="3 tháng">3 tháng</option>
              <option value="6 tháng">6 tháng</option>
              <option value="12 tháng">12 tháng</option>
            </select>
        </td>
        <td><label>Mã thiết bị</label></td>
        <td><input type="text" id="dvId"  name="dv_id" required=""></td>
      </tr>
      <tr>
        <td><label>Giá trị bđ</label></td>
        <td><input style="width: 80%; float: left;" type="text"  name="khbd" ><input style="width: 14%;float: left;margin-top: 6px;" class="form-control" value="đv %" disabled="">
          </td>
        <td><label style="font-size: 20px;">Khấu hao hn</label></td>
        <td><input style="width: 80%; float: left;" type="text"  name="khhn" ><input style="width: 14%;float: left;margin-top: 6px;" class="form-control" value="đv %" disabled="">
        </td>
      </tr>
      <tr>
        <td><label>Ghi chú</label></td>
        <td><input type="text"  name="note"></td>
        <td></td>
        <td>
          <div>
          <div style="float: left; margin-top: 2px;"><input value="Hoàn thành" class="btn" type="submit" style="margin-left: 50px;color: black;" ></div>
          <div style="float: left;margin-left: 5px;background-color:green " class="rgt1"><a id="luu"  class="rgt_canl" style="color: black; text-decoration: none;font-weight: bold;">Lưu</a></div>
          </div>
          <div style="float: left;margin-left: 5px;" class="rgt1"><a onclick="return luu()" class="rgt_canl" href="{{route('get.home')}}" style="color: black; text-decoration: none;font-weight: bold;">Hủy</a></div>
          </div>
        </td>
      </tr>
    </table> 
  </form>
</div>
<script>
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();
  if(dd<10) 
  {
    dd='0'+dd;
  } 
  if(mm<10) 
  {
    mm='0'+mm;
  } 
  today = dd+mm+yyyy;
  var g='X';
  var dvt='XXX';
  var text;
  var dv = '{{ $dvn }}';
  console.log(dv);
    $(document).ready(function(){
      $('#searchDvt').select2({});

      $('#group').on('change',function(){
        //var optionValue = $(this).val();
        //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
        g = $("#group option:selected").val();
        //  alert("Selected Option Text: "+optionText);  
    });
      $('#searchDvt').on('change',function(){
        //var optionValue = $(this).val();
        //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
        dvt = $("#searchDvt option:selected").val();
        //  alert("Selected Option Text: "+optionText);
        
    });
      // + $("#import_date").val()
      $('#luu').click(function(){
        text = g+dvt+'-'+today+'-'+dv;
        $('#dvId').val(text);
      });
  });
    
      
    
</script>
@endsection

