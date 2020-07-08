@extends('ktv.index')
@section('content')
<style>
input[type=text], input[type=date], input[type=number]{
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
        <td><label>Tên thiết bị <span style="color: red">*</span></label></td>
        <td><input type="text"  name="name_device" required></td>
        <td><label>Nhà cung cấp</label></td>
        <td><select type="text" name="provider">
        		<option value="">Nhà cung cấp</option>
        		@isset($providers)
        		@foreach($providers as $rows)
        		<option name="provider" value="{{$rows->id}}">{{$rows->provider_name}}</option>
        		@endforeach
        		@endif
        	</select></td>
      </tr>
       <tr>
        <td><label>Model<span style="color: red">*</span></label></td>
        <td><input type="text"  name="model" required></td>
        <td><label>Serial<span style="color: red">*</span></label></td>
        <td><input type="text"  name="serial" ></td>
      </tr>
       <tr>
        <td><label>Nhóm thiết bị<span style="color: red">*</span></label></td>
        <td>
            <select type="text" id="group" name="group" required="">
              <option value="X">X</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
        </td>
        <td><label>Loại thiết bị<span style="color: red">*</span></label></td>
        <td>
        	<select id="searchDvt" type="text" name="device_type" required>
        		
        	</select>
        </td>
          
      </tr>
       <tr>
        <td><label>Năm sản xuất<span style="color: red">*</span></label></td>
        <td><input type="text"  name="produce_date" required=""></td>  
        
        <td><label>Hãng sản xuất<span style="color: red">*</span></label></td>
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
        <td><label>Xuất xứ<span style="color: red">*</span></label></td>
        <td><input type="text"  name="country" required=""></td>
      </tr>
      <tr>
        <td><label>Số lưu hành</label></td>
        <td><input type="text"  name="license_number" ></td>
        <td><label style="font-size: 18px;">Ngày cấp SLH</label></td>
        <td><input type="date"  name="license_number_date" ></td>
      </tr>
       <tr>
        <td><label>Bảo dưỡng ĐK<span style="color: red">*</span></label></td>
        <td>
            <select type="text"  name="maintain_date">
              <option  value=""></option>
              <option value="hàng ngày">hàng ngày</option>
              <option value="1 tuần">1 tuần</option>
              <option value="1 tháng">1 tháng</option>
              <option value="2 tháng">2 tháng</option>
              <option value="3 tháng">3 tháng</option>
              <option value="6 tháng">6 tháng</option>
              <option value="12 tháng">12 tháng</option>
            </select>
        </td>
        <td><label>Mã thiết bị<span style="color: red">*</span></label></td>
        <td><input type="text" id="dvId"  name="dv_id" required=""></td>
      </tr>
      <tr>
        <td><label>Giá trị bđ</label></td>
        <td><input style="float: left;width: 20%;" type="number"  name="khbd" ><label style="width: 8%;float: left;margin-top: 6px;" class="form-control" value="%" disabled="">%</label>
          </td>
        <td><label style="font-size: 20px;">Khấu hao hn</label></td>
        <td><input style="width: 20%; float: left;" type="number"  name="khhn" ><input style="width: 8%;float: left;margin-top: 6px;" class="form-control" value="%" disabled="">
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
      {{ csrf_field() }}
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
        $.ajaxSetup({
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        g = $("#group option:selected").val();
        //  alert("Selected Option Text: "+optionText);  
        if(g != '')
        {          
         $.ajax({
         url:"{{ route('device.postAdd') }}", 
          method:"POST", // phương thức gửi dữ liệu.
          data:{query:g},
            success:function(data){ //dữ liệu nhận về
              console.log(data);
            $('#searchDvt').html(data.msg);
            },
            error: function(err){
              console.log("Co loi xay ra");
            }
            })
      }

    });
      $('#searchDvt').on('change',function(){
        dvt = $("#searchDvt option:selected").val();        
    });
      
      $('#luu').click(function(){
        text = g+dvt+'-'+today+'-'+dv;
        $('#dvId').val(text);
      });
  });
    
      
    
</script>
@endsection

