@extends('views.header_main')
@section('content')
<style type="text/css">
  input, select{
    font-size: 15px;
    border-radius: 3px;
  }
.fa-print{
  opacity: 0.7;
  font-size: 25px;
}
.fa-print:hover{
  opacity: 1;
}
</style>
<div class="form-group">
  <div><h3><b>Tìm kiếm thiết bị cần bàn giao</b></h3></div>
  <form>
    <table width="100%" >
      <tr>
        <td><div><input type="text" name="dvId" class="form-control" placeholder="nhập mã thiết bị"></div></td>
        <td><div style="margin-left: 10px;"><input type="text" name="dvName" class="form-control" placeholder="nhập tên thiết bị"></div></td>
        <td width="20%"><div style="margin-left: 10px;">
          <select id="dvt" class="form-control" name="dvt">
            <option  value="">Chọn loại thiết bị</option>
          @foreach($dvts as $dvt)
            <option value="{{$dvt->dv_type_id}}">{{$dvt->dv_type_name}}</option>
          @endforeach
        </select></div>
        </td>
        <td width="20%">
          <div style="margin-left: 10px;"><button class="btn btn-primary">Tìm kiếm</button></div>
        </td>
      </tr>
    </table>
  </form>
</div>
<br>

<div>
  @if(count($dvs))
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <th>Mã thiết bị</th>
      <th>Tên thiết bị</th>
      <th>Model</th>
      <th>Năm sản xuất</th>
      <th>Loại thiết bị</th>
      <th>Ngày nhập</th>
      <th>Tùy chọn</th>
    </thead>
    <tbody>
      
      @foreach($dvs as $r)
      <tr>
        <td>{{ $r->dv_id }}</td>
        <td>{{ $r->dv_name }}</td>
        <td>{{ $r->dv_model }}</td>
        <td>{{ $r->produce_date }}</td>
        <td>{{ \App\Device_type::where(['dv_type_id'=> $r->dv_type_id])->pluck('dv_type_name')->first() }}</td>
        <td>{{ $r->import_date }}</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.print.device',['id'=>$r->id,'user_id'=>Auth::user()->user_id]) }}" style="text-decoration: none;color: green;"><i class="fa fa-print" title="In phiếu bàn giao" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  @endif
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#dvt').select2({});
  })
</script>
@endsection
