@extends('header_main')
@section('content')
<div class="content">
    <div class="row">
      <div class="col-sm-4 col-3">
        <h4 class="page-title">Nhà cung cấp</h4>
      </div>
      <div class="col-sm-4 col-5 text-right m-b-10">

      </div>
      <div class="col-sm-4 col-4 text-right m-b-10">
        <a href="{{ route('provider.add')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Thêm nhà cung cấp</a>
      </div>
    </div>
    <form action="{{route('show.provider')}}" method="get">
    <div class="row">
        <div class="col-sm-4 col-4">
          <input class="form-control" name="searchName" style=" border-radius: 10px;" placeholder="Tên nhà cung cấp .... " />
        </div>
        <div class="col-sm-4 col-4">
          <input class="form-control" name="searchEmail" style=" border-radius: 10px;" placeholder="Email nhà cung cấp ..." />
        </div>
        <div class="col-sm-4 col-4" >
           <button  class="btn btn-primary btn-rounded "><i class="fa fa-search"> &nbsp;</i>Tìm kiếm</button>&nbsp;
        </div>
      </div>      
    </div> 
    </form>
    <div class="content">
        <table class="table table-condensed table-bordered table-hover">
          <thead style="background-color: #009efb;color: white" >
            <th>STT</th>
            <th>Nhà cung cấp</th>
            <th>Địa chỉ</th>
            <th>Người đại diện</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="5%"></th>
          </thead>
          <tbody>
              <?php $i=1 ?>
              @foreach($providers as $r)
              <tr>
                  <td>{{ $i++}}</td>
                  <td>{{ $r->provider_name }}</td>
                  <td>{{ $r->address }}</td>
                  <td>{{ $r->representator }}</td>
                  <td>{{ $r->mobile }}</td>
                  <td>{{ $r->email }}</td>
                  <td>
                    <a href="{{route('provider.getEdit',['id'=>$r->id])}}"><i class="fa fa-pencil-square-o " style="font-size: 15px;" title="Sửa" aria-hidden="true"></i></a>&nbsp;
                    <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('provider.del',['id'=>$r->id])}}"><i class="fa fa-trash" style="font-size: 15px;" title="Xóa" aria-hidden="true"></i></a>
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
</div> 

    

<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/Chart.bundle.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/app.js"></script>
@endsection