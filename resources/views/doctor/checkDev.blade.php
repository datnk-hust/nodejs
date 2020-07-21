@extends('views.header_main')
@section('content')

<style>
input[type=text], input[type=date]{
  width: 450px;
  padding: 5px;
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
  width: 100px;
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
}
.rgt1{
  margin-top: 17px;
}
.rgt{
  width: 120px;
  background-color: green;
  color: white;
  margin-left: 10px;
  margin-top: 10px;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
}
.rgt:hover{
  opacity: 1;
  cursor: pointer;
}
.form-container input[type=text],.form-container select[type=text]{
    width: 98%;
    padding: 3px;
    margin: 3px;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
    font-size: 18px;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,.form-container select[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn {
    background-color: #4CAF50;
    font-size: 20px;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 150px;
    margin-left:10px;
    opacity: 0.7;
  }
  /* Add a red background color to the cancel button */
  .form-container .cancel{
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover{
    opacity: 1;
  }

.rgt_canl{
  color: black; 
  background-color: #848484;
   text-decoration: none;
   font-weight: bold;
   opacity: 0.6;
   width: 100px;
  margin-top: 10px;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
}
.rgt_canl:hover{
  opacity: 1;
  text-decoration: none;
  color: black;
}
.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  margin-left: 40px;
  margin-top: 40px;
}
.form-popup {
    display: none;
    position: fixed;
    top: 200px;
    bottom: 200px;
    left: 200px;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    width: 900px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 700px;
    border-radius: 5px;
    max-height: 500px;
  }
  .hr-pop {
    margin: 0;
    padding-top: 2px;
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
<div style="font-size: 30px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Thông tin thiết bị</div>
<hr >
<div class="editKtv">
  <form action="{{route('device.postEdit',['id'=>$dev->id])}}" method="post">
  	     @csrf
    <table border="0" width="100%" >
      <tr>
        <td><label>Tên thiết bị</label></td>
        <td><input type="text"  name="name_device" value="{{$dev->dv_name}}" ></td>
        <td><label>Nhà cung cấp</label></td>
        <td>
          @if($dev->provider_id)
          <select type="text" name="provider">
        		<option value="{{$dev->provider_id}}">{{$dev->provider->provider_name}}</option>	
        	</select>
        @else
        <?php $pros = DB::table('provider')->get(); ?>
        <select type="text" name="provider">
          <option>Lựa chọn nhà cung cấp</option>
          @foreach($pros as $row)
          <option value="{{ $row->id }}">{{ $row->provider_name }}</option>
          @endforeach
        </select>
        @endif
      </td>
      </tr>
       <tr>
        <td><label>Model</label></td>
        <td><input type="text"  name="model" value="{{$dev->dv_model}}" ></td>
        <td><label>Serial</label></td>
        <td><input type="text"  name="serial" value="{{$dev->dv_serial}}" ></td>
      </tr>
       <tr>
        <td><label>Loại thiết bị</label></td>
        <td>
        	<select type="text" name="device_type" id="searchDvt" required>
        		<option value="{{$dev->dv_type_id}}">{{$dev->dv_type->dv_type_name}}</option>
        	</select>
        </td>
        <td><label>Hãng sản xuất</label></td>
        <td><input type="text"  name="produce" value="{{$dev->manufacturer}}" ></td>
      </tr>
       <tr>
        <td><label>Năm sản xuất</label></td>
        <td><input type="text"  name="produce_date" value="{{$dev->produce_date}}" ></td>
        <td><label>Nhóm thiết bị</label></td>
        <td><input type="text"  name="group" value="{{$dev->group}}" ></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date"  name="import_date" value="{{$dev->import_date}}" ></td>
        <td><label style="font-size: 18px;">Dự án thầu</label></td>
        <td><input type="text"  name="import_id" value="{{$dev->import_id}}" ></td>
      </tr>
      <tr>
        <td><label>Giá nhập</label></td>
        <td><input type="text"  name="price" value="{{$dev->price}}" ></td>
        <td><label>Xuất xứ</label></td>
        <td><input type="text"  name="country" value="{{$dev->country}}" ></td>
      </tr>
      <tr>
        <td><label>Số lưu hành</label></td>
        <td><input type="text"  name="license_number" value="{{$dev->license_number}}" ></td>
        <td><label style="font-size: 18px;">Ngày cấp SLH</label></td>
        <td><input type="date"  name="license_number_date" value="{{$dev->license_number_date}}" ></td>
      </tr>
       <tr>
        <td><label>Bảo dưỡng ĐK</label></td>
        <td><input type="text"  name="maintain_date" value="{{$dev->maintain_date}}" disabled=""></td>
       <td><label>Khoa</label></td>
        <td><input type="text"  name="department" value="{{\App\Department::where(['id' =>$dev->department_id])->pluck('department_name')->first() }}" disabled=""></td>
      </tr>
      <tr>
        <td><label>Giá trị bđ</label></td>
        <td><input style="width: 20%; float: left;" type="text"  name="khbd" value="{{ $dev->khbd}}" ><input style="width: 10%;float: left;margin-top: 6px;height: 40px;" class="form-control" value="%" disabled="">
          </td>
        <td><label style="font-size: 20px;">Khấu hao hn</label></td>
        <td><input style="width: 20%; float: left;" type="text"  name="khhn" value="{{ $dev->khhn}}"  ><input style="width: 10%;float: left;margin-top: 6px;height: 40px;" class="form-control" value="%" disabled="">
        </td>
      </tr>
      <tr>
        <td><label>Ghi chú</label></td>
        <td><input type="text"  name="note" value="{{$dev->note}}" ></td>
        <td><label>Mã thiết bị</label></td>
        <td><input type="text"  name="dv_id" value="{{$dev->dv_id}}" disabled></td>
      </tr>
      <tr>
       <td></td>
        <td colspan="3">

          
          <div>
          
          <div style="float: right;margin-left: 10px;" class="rgt1"><a class="rgt"  onclick="openForm1()" data-deviceid="{{$dev->status }}" style="color: black;; text-decoration: none;font-weight: bold;">Lịch sử sửa chữa</a></div>
          
          <div style="float: right;margin-left: 10px;" class="rgt1"><a class="rgt"  onclick="openForm()" data-deviceid="{{ $dev->status}}" style="color: black;; text-decoration: none;font-weight: bold;">Xem vật tư kèm theo</a></div>
           <div ><a style="text-decoration: none;float: right;color: black; font-size: 19px;margin-top: 10px;" href="{{route('device.view.image',['id'=>$dev->id])}}" class="btn btn-danger">Ảnh BG</a></div>
        </td>
      </tr>
    </table> 
  </form>
</div>

<div class="form-popup" id="myForm">
    <form action="#" class="form-container form">
      @csrf
      <div style="font-size: 20px;text-align: center;"><b>Danh sách vật tư kèm theo của thiết bị</b></div>
      <hr class="hr-pop" style="height: 1px;background-color: green;">
     <table class="table table-condensed table-bordered table-hover">
     <thead style="background-color: #81BEF7;">
      <tr style="font-size: 17px;">
        <th>Tên vật tư</th>
        <th>Số lượng</th>
        <th>Đơn vi tính</th>
        <th>Loại vật tư</th>
        <th>Ghi chú</th>
      </tr>
     </thead>
     <tbody>
      @if(isset($accs))
      @foreach($accs as $acc)
       <tr style="font-size: 15px;">
        <td>{{\App\Accessory::where(['id' =>$acc->acc_id])->pluck('acc_name')->first() }}</td>
        <td>{{ $acc->amount}} </td>
        <td>{{\App\Accessory::where(['id' =>$acc->acc_id])->pluck('unit')->first() }} </td>
        <td>
            {{\App\Accessory::where(['id' =>$acc->acc_id])->pluck('type')->first() }}
        </td>
        @if($acc->status == 0)
        <td>Vật tư thay thế</td>
        @else
        <td>Vật tư kèm theo thiết bị</td>
        @endif
      </tr>
      @endforeach
      @endif
      </tbody>
    </table>
    <div style="text-align: center;"><button type="button" class="btn" onclick="closeForm()">Đóng</button></div>
    </form>
  </div>

  <div class="form-popup" id="myForm1">
    <form action="#" class="form-container form">
      @csrf
      <div style="font-size: 20px;text-align: center;"><b>Lịch sử sửa chữa của thiết bị</b></div>
      <hr class="hr-pop" style="height: 1px;background-color: green;">
     <table class="table table-condensed table-bordered table-hover">
     <thead style="background-color: #81BEF7;">
      <tr style="font-size: 17px;">
        <th>Ngày báo hỏng</th>
        <th>Ngày sửa chữa</th>
        <th>Đơn vị sửa chữa</th>
        <th>Ghi chú</th>
      </tr>
     </thead>
     <tbody>
      @if(isset($hiss))
      @foreach($hiss as $his)
       <tr style="font-size: 15px;">
        <td>{{$his->schedule_date}}</td>
        <td>{{$his->proceed_date}} </td>
        <td> {{$his->repair_responsible}}</td>
        <th>{{ $his->note}}</th>
      </tr>
      @endforeach
      @endif
      </tbody>
    </table>
    <div style="text-align: center;"><button type="button" class="btn" onclick="closeForm()">Đóng</button></div>
    </form>
  </div>
  
<script type="text/javascript">
 function closeForm(){
        document.getElementById("myForm").style.display = "none";
        document.getElementById("myForm1").style.display = "none";
  }
function openForm1(){
        
                    document.getElementById("myForm1").style.display = "block";
          }
function openForm()
          {       
                   document.getElementById("myForm").style.display = "block";
          }

  </script>
@endsection


