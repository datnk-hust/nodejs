@extends('ktv.index')
@section('content')
<style type="text/css">
	.fa-history{
		font-size: 20px;
		opacity: 0.7;
		color: green;
	}
	.fa-history:hover{
		opacity: 1;
	}
	table{
		width: 100%;
		font-size: 17px;
	}
</style>
<div>
	<div>
	<form class="form-group"  method="get">
		<table>
			<tr>
				<td width="20%">
					<div><input type="text" name="dvId" class="form-control" placeholder="Nhập mã thiết bị " value=""></div>
				</td>
				<td width="20%">
					<div style="margin-left: 5px;"><input class="form-control" type="text" name="dvname" placeholder="Nhập tên thiết bị "> </div>
				</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select name="dept" class="form-control" >
						<option value="">Chọn khoa phòng</option>
						@foreach($depts as $d)
						<option value="{{ $d->id }}" {{ (request()->dept == $d->id) ? 'selected' : "" }}>{{ $d->department_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="15%">
					<div style="margin-left: 5px;">
						<select  name="dvt" class="form-control" value="{{request()->dvt}}">
						<option value="">Chọn loại thiết bị</option>
						@foreach($dvts as $r1)
						<option value="{{ $r1->dv_type_id }}" {{ (request()->dvt == $r1->dv_type_id) ? 'selected' : ""}}>{{ $r1->dv_type_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="15%">
					<div style="margin-left: 5px;"><a href=""><button class="btn btn-primary">Tìm kiếm </button></a> </div>
				</td>
				<td width="10%" style="text-align: left;">
					Tổng: <b>{{ count($devices) }}</b>
				</td>
			</tr>
			<tr><td colspan="6"><br></td></tr>
			<tr>
          		<td width="25%"> 
           		 <div >
            	<input  type="text" class="form-control" placeholder="Nhập Model thiết bị" name="model" value="{{request()->model}}">
            	</div>
         		 </td>
          			<td>
            		<div style="margin-left: 5px;">
            	<input  type="text" class="form-control" placeholder="Nhập Serial thiết bị" name="serial" value="{{request()->serial}}">
            		</div>
          		</td>
          		<td colspan="2"><div style="margin-left: 5px;">
            	<input  type="text" class="form-control" placeholder="Nhập tên dự án gói thầu" name="import_id" value="{{request()->import_id}}">
            		</div></td>
          		<td colspan="2">
          			<div style="margin-left: 5px;" class="export">
     					<a  href="#" ><button formaction ="{{ route('device.export')}}" class="btn btn-success" type="submit">
     						Xuất file thống kê
     					</button>
     					</a>

     					
     					 
					</div>
          		</td>
        	</tr>
        	
		</table>
	</form>
	</div>
	<div>
		<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="15%">Mã thiết bị</th>
				<th width="25%">Tên thiết bị</th>
				<th width="10%">Model</th>
				<th width="10%">Serial</th>
				<th width="20%">Nhà cung cấp</th>
				<th width="5%">Năm SX</th>
				<th width="5%">Chi tiết</th>
			</thead>
			<tbody>
				@if(isset($devices))
				@foreach($devices as $r)
				<tr>
					<td>{{ $r->dv_id }}</td>
					<td>{{ $r->dv_name }}</td>
					<td>{{ $r->dv_model }}</td>
					<td>{{ $r->dv_serial }}</td>
					@if($r->provider_id != '')
				<td>{{$r->provider->provider_name}}</td>
				@else
				<td></td>
				@endif
					<td>{{ $r->produce_date }}</td>
					<td style="text-align: center;">
						<a  href="{{ route('device.view',['id'=>$r->id]) }}"><i  title="Xem hồ sơ" class="fa fa-history" aria-hidden="true"></i></a>
					</td>
					
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<div class="page-nav text-right">
		<nav aria-label="Page navigation">
			{{$devices->links()}}
		</nav>
	</div>
</div>
@endsection