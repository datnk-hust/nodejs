@extends('header_main')
@section('content')
<style>
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
 <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Danh sách vật tư</h4>
            </div>
            <div class="col-sm-4 col-5 text-right m-b-10">
                
          </div>
          <div class="col-sm-4 col-4 text-right m-b-10">
            <a href="{{route('accessory.add')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Thêm vật tư mới</a>
        </div>
    </div>
    <form action="{{route('accessory.show')}}">
      <div class="row">
        
        <div class="col-sm-4 col-4">
          <input class="form-control" name="acc_name" style=" border-radius: 10px;" placeholder="Tên vật tư ..." />
        </div>
        <div class="col-sm-4 col-4">
          <select style="width: 100% ; height: 100% ;border-radius: 10px; border: 1px solid #f1f1f1" name="provider_id">
          <?php $prs = DB::table('provider')->get()?>  
          <option value="">Chọn nhà cung cấp</option>
          @foreach($prs as $r)
            <option value="{{ $r->id }}">{{ $r->provider_name }}</option>
          @endforeach
          </select>
        </div>
        <div class="col-sm-4 col-4" >
           <button class="btn btn-primary btn-rounded "><i class="fa fa-search"> &nbsp;</i>Tìm kiếm</button>&nbsp;
        </div>
      </div>
      </form>
</div> 
    <div class="content">
        <table class="table table-condensed table-bordered table-hover">
          <thead>
            <th>STT</th>
            <th>Tên vật tư</th>
            <th>Số lượng</th>
            <th>Đã dùng</th>
            <th>Đơn vị</th>
            <th>Năm sản xuất</th>
            <th>Ngày nhập kho</th>
            <th width="8%"></th>
          </thead>
          <tbody>
              <?php $i=1 ?>
              @foreach($accs as $r)
              <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $r->acc_name }}</td>
                  <td>{{ $r->amount }}</td>
                  <td>{{ $r->used }}</td>
                  <td>{{ $r->unit }}</td>
                  <td>{{ $r->produce_date }}</td>
                  <td>{{ $r->import_date }}</td>
                  <td>
                    <a href="{{ route('acc.selectDevice',['id'=>$r->id]) }}"><i class="fa fa-share " title="Thiết bị tương thích" style="font-size: 15px" aria-hidden="true"></i></a>
                        &nbsp;
                    <a href="{{route('accessory.getEdit',['id'=>$r->id])}}"><i class="fa fa-pencil-square-o " title="Sửa" style="font-size: 15px" aria-hidden="true"></i></a>&nbsp;
                    <a class="add" data-deviceid="{{$r->id}}"><i class="fa fa-plus " style="font-size: 15px;cursor: pointer;" title="Thêm số lượng" aria-hidden="true"></i></a>
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
    
  </div>
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