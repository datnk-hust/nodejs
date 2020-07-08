@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding-left: 3px;
    font-size: 20px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 20px;
    margin-top: 30px;
  }
  .btn{
    padding: 10px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
.fa-pencil-square-o:hover{
    border-radius: 4px;
    background-color: yellow;
  }
  .fa-plus:hover{
    border-radius: 4px;
    color: red;
  }
  .ban_giao{
    cursor: pointer;
  }
  .ban_giao:hover{
    background-color: red;
  }
  .form-popup {
    display: none;
    position: fixed;
    top: 300px;
    bottom: 200px;
    left: 500px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 350px;
    border-radius: 5px;
  }

  
  /* Full-width input fields */
  .form-container input[type=text],.form-container select[type=text]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
    font-size: 18px;
  }
 
  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,.form-container select[type=text]:focus{
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn{
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
  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }
</style>
<h2>Danh Sách Vật Tư Kèm Theo</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td width="35%">
            <input style="width: 98%;" type="text" class="form-control" placeholder="Tên vật tư" name="acc_name" value="{{request()->acc_name}}">
          </td>
          <td width="35%">
            <select class="form-control" name="provider_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Mọi nhà cung cấp</option>
              @if(isset($providers))
              @foreach($providers as $rows)
              <option value="{{ $rows->id }}" {{ (request()->provider_id == $rows->id) ? 'selected' : "" }} >
                {{ $rows->provider_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td width="25%">
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;margin-left: 10px"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
          </td>
          <td width="5%" style="text-align: left;font-size: 18px;">Tất cả: {{$accs->total()}}</td>
        </tr>
      </table>  
    </form>
  </div>
  <br><br><br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên vật tư</th>
        <th>Nhà cung cấp</th>
        <th>Số lượng</th>
        <th>Đã dùng</th>
        <th>Đơn vị tính</th>
        <th>Năm sản xuất</th>
        <th>Ngày nhập kho</th>
        <th width="10%">Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      @foreach($accs as $acc)
      <tr style="font-size: 15px;">
        <td>{{ $i++ }}</td>
        <td>{{$acc->acc_name}}</td>
        <td>{{ \App\Provider::where(['id' => $acc->provider_id])->pluck('provider_name')->first() }}</td>
        <td>{{ $acc->amount }}</td>
        <td>{{ $acc->used }}</td>
        <td>{{ $acc->unit }}</td>
        <td>{{ $acc->produce_date }}</td>
        <td>{{ $acc->import_date }}</td>
        <td style="text-align: center;">
          <a href="{{ route('acc.selectDevice',['id'=>$acc->id]) }}"><i class="fa fa-share " title="Thiết bị tương thích" style="font-size: 20px" aria-hidden="true"></i></a>
          &nbsp;&nbsp;
          <a href="{{route('accessory.getEdit',['id'=>$acc->id])}}"><i class="fa fa-pencil-square-o " title="Sửa" style="font-size: 20px" aria-hidden="true"></i></a>&nbsp;&nbsp;
          <a class="add" data-deviceid="{{$acc->id}}"><i class="fa fa-plus " style="font-size: 20px;cursor: pointer;" title="Thêm số lượng" aria-hidden="true"></i></a>
          
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$accs->links()}}
    </nav>
  </div>
</div>
<!-- form bàn giao vật tư -->

  <!-- form nhập thêm số lượng vật tư -->
 <div class="form-popup" id="myForm1">
    <form action="{{route('accessory.plus',['id','user_id'=>Auth::id()])}}" class="form-container form1" method="post">
      @csrf
      <table>
        <tr>
          <td colspan="2"><label  style="text-align: center; font-size: 20px;"><b>Nhập thêm số lượng vật tư</b></label></td>
        </tr>
        <tr><td colspan="2"><hr style="height: 3px;background-color: green;"></td></tr>
        <tr>
          <td colspan="2"><div style="margin-left: 10px;"><span style="font-size: 20px;font-weight: bold;">Số lượng</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="amount" style="width: 300px;height: 40px;margin-left: 45px;" required></div></td>
        </tr>
        <tr>
          <td colspan="2"><div style="margin-left: 10px;"><span style="font-size: 20px;font-weight: bold;">Ngày nhập</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="date"  name="import_date" style="width: 300px;height: 40px;border-radius: 5px;" value="{{date('Y-m-d')}}"></div></td>
        </tr>
        <tr>
          <td colspan="2"><div style="padding: 10px;margin-left: 50px;"><button type="submit" class="btn" onclick="return confirm('Bạn có chắc chắn nhập thêm số lượng cho vật tư?')">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></div></td>
        </tr>
      </table>
    </form>
  </div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchDv').select2({});
  })
 function closeForm() {
        // document.getElementById("myForm").style.display = "none";
        document.getElementById("myForm1").style.display = "none";
  }
//nhập thêm số lượng
  $(document).on('click', '.add', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');

    // Lấy action hiện tại của form theo class
    var action = $('.form1').attr('action');
    // Thay thế id data vào đoạn action của form

    var actions = $('.form1').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm1").style.display = "block";
  });
  </script>
@endsection
