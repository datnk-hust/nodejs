@extends('header_main')
@section('content')
<style type="text/css">
  h2, h3{
    margin-left: 40px;
    font-weight: bold;
  }
</style>
<table width="100%">
  <tr>
    <td colspan="2">
      <h2>Hồ Sơ Thiết Bị: {{ \App\Device::where(['id' => $dv])->pluck('dv_name')->first()}}</h2>
    </td>
    <td>
      <div style="padding: 5px;float: left; background-color: yellow;text-align: center; margin-left: 40px;border-radius: 5px;" ><a style="text-decoration: none;color: black;font-size: 20px;" href="{{ route('device.getEdit',['id'=>$dv])}}"><b>Thông tin thiết bị</b></a></div>
    </td>
  </tr>
  <tr>
    <td>
      <h3>Mã thiết bị: {{ \App\Device::where(['id' => $dv])->pluck('dv_id')->first()}}</h3>
    </td>
    <td>
      <h3>Model: {{ \App\Device::where(['id' => $dv])->pluck('dv_model')->first()}}</h3>
    </td>
    <td>
        <h3>Serial: {{ \App\Device::where(['id' => $dv])->pluck('dv_serial')->first()}}</h3>
    </td>
  </tr>
</table>
<br>
<br>
<div class="container2">
  <br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 18px;">
        <th>Thời gian</th>
        <th>Hoạt động - Tình trạng</th>
        <th>Thực hiện</th>
        <th>Ghi chú</th>   
      </tr>
    </thead>
    <tbody>
      @if(isset($hiss))
      @foreach($hiss as $his)
      <tr>
        <td>{{ $his->time }}</td>
        <td>{{ $his->action }}</td>
        <td>{{ $his->implementer }}</td>
        <td>{{ $his->note }}</td>
      </tr>
      @endforeach
      @endif
        @if(isset($file))
        @foreach($file as $row)
      <tr style="font-size: 15px;">
        <td>{{$row->time}}</td>
        <td>{{$row->action}}</td>
        <td>{{$row->implementer}}</td>
        <td>{{ $row->note }}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection


