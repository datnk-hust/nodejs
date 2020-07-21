@extends('header_main')
@section('content')
<div class="content">
    <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Danh sách thiết bị</h4>
            </div>
            <div class="col-sm-4 col-5 text-right m-b-10">
               <!--  <div class="container-1">                  
                  <input class="form-control" style=" border-radius: 10px;" placeholder="Search..." />
              </div> -->
          </div>
          <div class="col-sm-4 col-4 text-right m-b-10">
            <a href="adduser.html" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Thêm thiết bị mới</a>
        </div>
    </div>
    <div class="content">
      <div class="row">
        <div class="col-sm-3 col-3">
          <input class="form-control" style=" border-radius: 10px;" placeholder="Tìm kiếm theo mã thiết bị" />
        </div>
        <div class="col-sm-3 col-3">
          <input class="form-control" style=" border-radius: 10px;" placeholder="Tìm kiếm theo tên thiết bị..." />
        </div>
        <div class="col-sm-3 col-3">
          <select style="width: 100% ; height: 100% ;border-radius: 10px; border: 1px solid #f1f1f1" name="cars" id="cars">
            <option value="">Chọn khoa phòng</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
          </select>
        </div>
        <div class="col-sm-3 col-3">
          <select style="width: 100% ; height: 100% ;border-radius: 10px; border: 1px solid #f1f1f1" name="cars" id="cars">
            <option value="">Chọn loại thiết bị</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
          </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-3 col-3">
          <input class="form-control" style=" border-radius: 10px;" placeholder="Tìm kiếm theo Serial..." />
        </div>
        <div class="col-sm-3 col-3">
          <input class="form-control" style=" border-radius: 10px;" placeholder="Tìm kiếm theo Model..." />
        </div>
        <div class="col-sm-3 col-3">
          <input class="form-control" style=" border-radius: 10px;" placeholder="Tìm kiếm tên dự án gói thầu..." />
        </div>
        <div class="col-sm-3 col-3" style="text-align: center;">
           <a href="#" class="btn btn-primary btn-rounded "><i class="fa fa-search"> &nbsp;</i>Tìm kiếm</a>&nbsp;
           <a href="#" class="btn btn-success btn-rounded float-right"><i class="fa fa-file-excel-o"> &nbsp;</i>Xuất excel</a>
        </div>
      </div>
    </div>
    <br>
    <div class="">
        <div class="tab">
          <button class="tablinks" onclick="opentabsdevice(event, 'all')">ALL</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'unused')">Chưa bàn giao</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'doing')">Đang sử dụng</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'error')">Đang báo hỏng</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'repair')">Đang sửa chữa</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'stopusing')">Đã ngưng</button>
          <button class="tablinks" onclick="opentabsdevice(event, 'liquidation')">Đã thanh lý</button>
        </div>
        <br>
          <div id="all" class="tabcontent">
              <table class="table table-condensed table-bordered table-hover">
                  <thead>
                      <th>STT</th>
                      <th>Mã thiết bị</th>
                      <th>Tên thiết bị</th>
                      <th>Model</th>
                      <th>Serial</th>
                      <th>Hãng sản xuất</th>
                      <th width="10%"></th>
                  </thead>
                  <tbody>
                      <?php $i = 1 ?>
                      @foreach($devs as $r)
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $r->dv_id }}</td>
                          <td>{{ $r->dv_name }}</td>
                          <td>{{ $r->dv_model }}</td>
                          <td>{{ $r->dv_serial }}</td>
                          <td>{{ $r->manufacturer }}</td>
                          <td>
                          <a href="{{route('device.getAcc',['id'=>$r->id])}}"><i class="fa fa-medkit" style="font-size: 15px;" title="Nhập vật tư kèm theo" aria-hidden="true"></i></a>&nbsp;
					<a class="ban_giao" data-deviceid="{{$r->id}}"><i class="fa fa-arrow-circle-o-up" style="font-size: 15px;cursor: pointer;" title="Bàn giao" aria-hidden="true"></i></a>&nbsp;
					<a href="{{route('device.getEdit',['id'=>$r->id])}}"><i class="fa fa-pencil-square-o" style="font-size: 15px;" title="Thông tin" aria-hidden="true"></i></a>&nbsp;
					<a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('device.del',['id'=>$r->id])}}"><i class="fa fa-trash" style="font-size: 15px;" title="Xóa" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="page-nav text-right">
            <nav aria-label="Page navigation">
            {{$devs->links()}}
            </nav>
        </div>
          </div>

          <div id="unused" class="tabcontent" style="display: none;">
              <h3>unused</h3>
              <p>unused chưa được bàn giao</p> 
          </div>

          <div id="doing" class="tabcontent" style="display: none;">
              <h3>doing</h3>
              <p>Đang sử dụng</p>
          </div>

          <div id="error" class="tabcontent" style="display: none;">
              <h3>error</h3>
              <p>Thiết bị lỗi</p>
          </div>

          <div id="repair" class="tabcontent" style="display: none;">
              <h3>repair</h3>
              <p>Đang sửa chữa</p>
          </div>
          <div id="stopusing" class="tabcontent" style="display: none;">
              <h3>stopusing</h3>
              <p>Ngừng sử dụng</p>
          </div>
          <div id="liquidation" class="tabcontent" style="display: none;">
              <h3>liquidation</h3>
              <p>thanh lý</p>
          </div>
    </div>
    
</div> 

<script>
function opentabsdevice(evt, statusdevice) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(statusdevice).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/Chart.bundle.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/app.js"></script>

@endsection