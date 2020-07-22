<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\DeviceExport;
use App\Exports\DeviceExportQuery;
use Response;
use App\User;
use Hash;
use App\Provider;
use App\Notification;
use App\Device;
use App\Device_type;
use App\Maintenance_schedule;
use App\Accessory;
use App\Device_accessory;
use App\Department;
use App\History_ktv;
use App\ScheduleAction;
use App\CheckMaintain;
use Image;




class UserController extends Controller
{
    //ktv
    public function index(){
        //return view ('ktv.index');
        return view ('header_main');
    }

    public function notice(Request $request){
        $notices = DB::table('notification')->where('status',1)->orWhere('status',3)->orWhere('status',17)->orderBy('id','desc')->paginate(10);
        //return view('ktv.trangchu',['notices'=>$notices]);
        return view ('header_main');
    }

    public function deleteNotification($id){
        $not = Notification::find($id);
        $not->delete();
        return redirect()->route('get.home');
    }
    public function getEditKTV($id){
    	$user=User::find($id);
      return view('ktv.editKtv')->with(['user'=>$user]);
  }

  public function postEditKTV(Request $request, $id){
   $this->validate($request,
    [
        'phone' => 'min:9'
    ],
    [
        'phone.min'=>'Số điện thoại ít nhất 9 chữ số!'
    ]);
   $user=User::find($id);
   $user ->fullname = $request->fullname;
   $user ->mobile = $request->phone;
   $user ->address = $request->address;
   $user->save();
   return redirect()->route('get.home')->with('message','Cập nhật thông tin thành công!');
}

public function getPswKTV($id){
   $user=User::find($id);
   return view('ktv.setPsw')->with(['user'=>$user]);
}

public function postPswKTV(Request $request, $id){
    $user = User::find($id);
         $this->validate($request,
        [
            'new_psw' => 'different:current-psw',
            'repeat-psw' => 'same:new_psw',

         ],
         [
    'new_psw.regex'=>'Mật khẩu tối thiểu 6 và tối đa 20 kĩ tự, bao gồm chữ thường, chữ hoa và số ',
    'new_psw.different'=>'Mật khẩu mới phải khác mật khẩu cũ!',
    'repeat_psw.same'=>'Mật khẩu xác nhận không khớp!'
    ]);
        $user->password = Hash::make($request->new_psw);
        $user->save();
     return redirect()->route('get.home')->with('message','Cập nhật mật khẩu thành công!');

}
//accept notice biến cần tuyền từ route sang theo đúng thứ tự $user_id, $id, $dv_id, $status
public function acceptNotice( $user_id, $id, $dv_id, $status){
    $notice = Notification::find($id);
    $sender = $notice->annunciator_id;
    $dept = $notice->dept_next;
    $dep_now = Department::where(['id'=>$notice->dept_now])->pluck('department_name')->first();
    $dep_next = Department::where(['id'=>$notice->dept_next])->pluck('department_name')->first();
    $device = DB::table('device')->where('id','=',$dv_id)->first();
    
    if((int)$status == 0)
    {
        $notice->status = 1;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận thông báo hỏng";
        $notice->save();
        $response = new Notification;
        $response->req_date = Carbon::now('Asia/Ho_Chi_Minh');
        $response->req_content = "Phòng vật tư đã xác nhận thông báo hỏng thiết bị ".$device->dv_name;
        $response->status = 4;
        $response->dv_id = $dv_id;
        $response->receiver = $sender;
        $notice->receiver = 1;
        $response->save();
        
    }
    if((int)$status == 1){
        $notice->status = 0;
        $notice->save();
    }
    if((int)$status == 3){
        $notice->status = 2;
        $notice->save();
    }
    if((int)$status == 16){
        $notice->status = 15;
        $notice->save();
    }
    if((int)$status == 2)
    {
        // xác nhận thông báo
        $notice->status = 3;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận điều chuyển thiết bị ".$device->dv_name;
        $notice->save();

        //tạo thông báo gửi phòng đã điều chuyển
        $response = new Notification;
        $response->req_date = Carbon::now('Asia/Ho_Chi_Minh');
        $response->req_content = " Phòng vật tư xác nhận điều chuyển thiết bị ".$device->dv_name .' đến  '. \App\Department::where(['id'=>$dept])->pluck('department_name')->first();
        $response->status = 6;
        $response->dv_id = $dv_id;
        $response->annunciator_id = 'Phòng vật tư';
        $response->receiver = $sender;
        $response->save();
        $his = new History_ktv;
        $his->time = Carbon::now('Asia/Ho_Chi_Minh');
        $his->action = 'Thiết bị được điều chuyển từ '.$dep_now.' đến '.$dep_next;
        $his->implementer = 'Phòng vật tư';
        $his->dv_id = $device->dv_id;
        $his->note = 'Điều chuyển thiết bị';
        $his->status = 'ddv'; //direction device
        $his->save();
        //điều chuyển thiết bị về trang thái chưa bàn giao
         Device::where('id','=',$dv_id)->update(['department_id'=>$dept]);  
    }
    if((int)$status == 16){
        $notice->status = 17;
        $notice->res_date = Carbon::now();
        $notice->save();
    }
    return redirect()->route('get.home');
}

    //provider


public function showProvider(Request $request){
  $provider =  DB::table('provider');
  if($request->searchName)
  {
    $provider = $provider->where('provider_name','like','%'.$request->searchName.'%');
}
if($request->searchEmail)
{
    $provider = $provider->where('email','like','%'.$request->searchEmail.'%');
}
$provider = $provider->paginate(10);  
 return view('ktv.provider',['providers' => $provider]);
}

public function getEditProvider($id){
  $provider = Provider::find($id);
  return view('ktv.provider.edit',compact('provider'));
}

public function postEditProvider(Request $request, $id){
  $provider = Provider::find($id);
  $this->validate($request,[
      'email'=>'email',
  ],[
   'email.email'=>'Email không đúng định dạng!'
]);
  $provider->provider_name = $request->nameProvider;
  $provider->address = $request->address;
  $provider->representator = $request->representator;
  $provider->mobile = $request->phone;
  $provider->email = $request->email;
  $provider->save();
  return redirect()->route('show.provider')->with(['message'=>'Cập nhật thành công!','provider'=>$provider]);
}

public function getAddProvider(){
   return view('ktv.provider.add');
}

public function postAddProvider(Request $request){
   $this->validate($request,[
      'nameProvider' => 'required|unique:provider,provider_name',
  ],[
      'nameProvider.required' => 'Tên nhà cung cấp chưa được nhập.',
      'nameProvider.unique' => 'Nhà cung cấp này đã tồn tại, vui lòng kiểm tra danh sách nhà cung cấp.'
  ]);
   $provider = new Provider;
   $provider->provider_name = $request->nameProvider;
   $provider->address = $request->address;
   $provider->representator = $request->representator;
   $provider->mobile = $request->phone;
   $provider->email = $request->email;
   $provider->save();
   return redirect()->route('show.provider')->with(['message'=>'Thêm nhà cung cấp thành công.','provider'=>$provider]);
}

public function deleteProvider($id){
 $provider = Provider::findOrFail($id);
 $provider->delete();    
 return redirect()->route('show.provider')->with(['message'=>'Xóa một người dùng thành công','provider'=>$provider]);
}
    //Deviceall

    function allDevice (Request $request){
        $dev = DB::table('device')->orderBy('id','desc')->paginate(10);
        return view('ktv.device')->with(['devs'=>$dev]);
    }
    //list device not used status=0
public function showDevice0(Request $request){
    $devices = Device::where('status', 0)->orderBy('id','desc');
    $dv_types = DB::table('device_type')->get();
    $dept = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->import_id){
        $devices = Device::where('import_id','like','%'. $request->import_id. '%')->orderBy('id','desc');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->dv_type_id)
    {
        $devices = $devices->where('dv_type_id', '=', $request->dv_type_id);
    }

    $devices = $devices->paginate(10);

    return view('ktv.device.list0', ['devices'=>$devices,'dv_types'=>$dv_types,'depts'=>$dept,'providers'=>$provider]);
}
    //list device used status =1
public function showDevice1(Request $request){
    $devices = Device::where('status', 1)->orderBy('id','desc');
    $dept = DB::table('department')->get();
    $dvt = DB::table('device_type')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
     if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->import_id){
        $devices = Device::where('import_id','like','%'. $request->import_id. '%')->orderBy('id','desc');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('dv_type_id', '=', $request->dvt_id);
    }
    if($request->department_id)
    {
        $devices = $devices->where('department_id', '=', $request->department_id);
    }

    $devices = $devices->paginate(10);
    return view('ktv.device.list1',['devices'=>$devices,'dvts'=>$dvt,'depts'=>$dept]);

}
    //list device broken status=2
public function showDevice2(Request $request){
    $devices = Device::where('status', 2)->orderBy('id','desc');
    $department = DB::table('department')->get();
    $dv_type = DB::table('device_type')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->import_id){
        $devices = Device::where('import_id','like','%'. $request->import_id. '%')->orderBy('id','desc');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->dv_type_id)
    {
        $devices = $devices->where('dv_type_id', '=', $request->dv_type_id);
    }
    $devices = $devices->paginate(10);
    return view('ktv.device.list2',['devices'=>$devices, 'depts' => $department,'dv_types'=>$dv_type]);
}
    //device fixing
public function showDevice3(Request $request) {
    $dept = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    $device = Device::where('status',3)->orderBy('id','desc');
    if($request->dv_name)
    {

        $device = $device->where('dv_name','like','%'.$request->dv_name.'%');
    }
     if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->provider_id)
    {
        $device  = $device->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $device = $device->where('department_id', '=', $request->department_id);
    }
    $device = $device->paginate(10);
    return view('ktv.device.list3',['devices'=>$device,'departments'=>$dept,'providers'=>$provider]);
}

    //device stop used

public function scheduleRepair(Request $request, $id){
    $device = Device::find($id);
    $device->status = 3;
    $device->save();
    $schedule = new Maintenance_schedule;
    $schedule->schedule_date = $request->fix_date;
    $schedule->dv_id = $id;
    $schedule->repair_responsible = $request->name_repair;
    $schedule->information = $request->infor_repair;
    $schedule->status = 0;
    $schedule->save();
    //code them ngay 20-5 lich su thiet bi
    $his = new History_ktv;
    $his->time = $request->fix_date;
    $his->action = 'Tạo lịch sửa chữa';
    $his->dv_id = $device->dv_id;
    $his->status = 'of';//of = order-fix
    $his->implementer = 'Phòng vật tư';
    $his->note = 'Tạo lịch sửa chữa thiết bị';
    $his->save();
    return redirect()->route('device.show2')->with('message', 'Đã tạo lịch sửa chữa thành công cho thiết bị '.$device->dv_name);
}
    // edit schedule
public function editSchedule(Request $request, $id){
    $schedule = Maintenance_schedule::find($id);
    if($request->schedule_date){
        $schedule->schedule_date = $request->schedule_date; 
    }
    if($request->name_repair){
        $schedule->repair_responsible = $request->name_repair;                
    }
    if($request->information){
        $schedule->information = $request->information;                
    }
    $schedule->save();
    return redirect()->route('device.show3')->with('message','Cập nhật thành công');
}
    //update status device
public function updateStatus(Request $request, $id){
    $device = Device::find($id);
    $dvname = $device->dv_name;
    $his = new History_ktv;
    $notice = new Notification;
    $his->dv_id = $device->dv_id;
    $his->time = $request->update_time;
    if($request->status == '0'){
        $device->status = 1;
        $history = Maintenance_schedule::where('status',0)->where('dv_id',$id)->first();
        $history->status = 1;
        $history->proceed_date = $request->update_time;
        $history->note = $request->note;
        //tạo lịch sử tb
        $his->action = 'Đã sửa chữa thành công';
        $his->status = 'sf';//sf = success fix
        $his->note = $request->note;
        $his->implementer = 'Phòng vật tư';
        //tạo thông báo cho  khoa
        $notice->req_content = " Thiết bị ".$dvname." đã được sửa chữa và hoạt động tốt, yêu cầu khoa phụ trách xác nhận tình trạng thiết bị khi nhận bàn giao lại";
        $notice->status = 14;
        $notice->dv_id = $id;
        $notice->annunciator_id = 'Phòng vật tư';
        $notice->req_date = Carbon::now();
        $notice->receiver = $device ->department_id;
        $notice->save();
    }
    if($request->status == '4'){
        $device->status = 4;
        $device->department_id = 1;
        $history = Maintenance_schedule::where('status',0)->where('dv_id',$id)->first();
        $history->status = 2;
        $history->proceed_date = $request->update_time;
        $history->note = $request->note;
        $his->action = 'Không thể sửa chữa, chuyển vào kho thanh lý';
        $his->status = 'ff';//ff = faile fix
        $his->implementer = 'Phòng vật tư';
        $his->note = $request->note;


    }
    
    $device->save();
    $history->save();
    $his->save();
    return redirect()->route('device.show3')->with('message','Cập nhật trạng thái thiết bị thành công');
}

    // device stop used
public function showDevice4(Request $request) {
    $devices = Device::where('status',4)->orderBy('id','desc');
    $dep = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
     if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->import_id){
        $devices = Device::where('import_id','like','%'. $request->import_id. '%')->orderBy('id','desc');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $devices = $devices->where('department_id', '=', $request->department_id);
    }
    $devices = $devices->paginate(10);
    return view('ktv.device.list4',['devices'=>$devices,'depts'=>$dep,'providers'=>$provider]);

}

public function showDevice5(Request $request){
    $devices = Device::where('status',5)->orderBy('id','desc');
    $dep = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
     if($request->model)
    {
        $devices = $devices->where('dv_model', '=', $request->model);
    }if($request->serial)
    {
        $devices = $devices->where('dv_serial', '=', $request->serial);
    }
    if($request->import_id){
        $devices = Device::where('import_id','like','%'. $request->import_id. '%')->orderBy('id','desc');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $devices = $devices->where('department_id', '=', $request->department_id);
    }
    $devices = $devices->paginate(10);
    return view('ktv.device.list5',['devices'=>$devices,'depts'=>$dep,'providers'=>$provider]);
}
    
//sale device
public function saleDevice(Request $request, $id){
    $device = Device::find($id);
    $dvname = $device->dv_name;
    $device->status = 5;
    $device->sale_date = $request->sale_date;
    $device->saler = $request->saler;    
    //tao lich su
    $his = new History_ktv;
    $his->action = "Thanh lý thiết bị";
    $his->time = Carbon::now();
    $his->dv_id = $device->dv_id;
    $his->status = 'sdv'; //sdv = sale device
    $his->implementer = 'Phòng vật tư';
    $his->note = 'Đã thanh lý thiết bị';
    $his->save();
    $device->save();
    return back()->with('message','Đã thanh lý thiết bị '.$dvname);
}
//add device
public function getAddDevice(){
    $dv_types = DB::table('device_type')->get();
    $provider = DB::table('provider')->get();
    $dv = DB::table('device')->get();
    $dvnum = count($dv)+1;
    return view('ktv.device.add',['dv_types'=>$dv_types,'providers'=>$provider,'dvn'=>$dvnum]);
}

public function postAddDevice(Request $request){
    //
     if($request->get('query'))
        {
            $query = $request->get('query');

            $data = DB::table('device_type')
            ->where('dv_group', 'LIKE', "%{$query}%")
            ->get();
            //dd($data);
            $output = '<option value="">chọn loại thiết bị</option>';
            foreach($data as $row)
            {
               $output .= '<option value="'.$row->dv_type_id.'">'.$row->dv_type_name.'</option>
               ';
           }
           //echo $output;
           return response()->json(['msg'=>$output]) ;
       }else{
    $this->validate($request,[
        'name_device' => 'required',
        'serial' => 'unique:device,dv_serial',
        'amount' => 'numeric',
        'dv_id' => 'unique:device,dv_id'
    ],[
        'name_device.required' => 'Bạn phải nhập tên thiết bị',
        'amount.numeric'=>'Số lượng phải là số tự nhiên',
        'dv_id.unique' => 'Mã thiết bị này đã tồn tại vui lòng nhập mã khác'
    ]);

    $device = new Device;
    $device->dv_name = $request->name_device;
    $device->dv_model = $request->model;
    $device->dv_serial = $request->serial;
    $device->dv_type_id = $request->device_type;
    $device->manufacturer = $request->produce;
    $device->produce_date = $request->produce_date;
    $device->import_id = $request->import_id;
    $device->import_date = $request->import_date;
    $device->group = $request->group;
    $device->note = $request->note;
    $device->price = $request->price;
    $device->country = $request->country;
    $device->provider_id = $request->provider;
    $device->license_number = $request->license_number;
    $device->license_number_date = $request->license_number_date;
    $device->khbd = $request->khbd;
    $device->khhn = $request->khhn;
    $device->maintain_date = $request->maintain_date;
    $device->dv_id = $request->dv_id;
    $device->status = 0;
    $device->save();
    $dv = DB::table('device')->where('dv_name',$request->name_device)->get();
    //tạo lịch sử nhập mới thiết bị
    $his = new History_ktv;
    $his->status = 'sadv'; //sadv = success add DV
    $his->action = 'Nhập mới thiết bị '.$request->name_device;
    $his->dv_id = $request->dv_id;
    $his->time = date('Y-m-d');
    $his->implementer = 'Phòng vật tư';
    $his->note = 'Mua mới thiết bị';
    $his->save();
    return redirect()->route('device.show0')->with('message','Thêm thiết bị thành công');
}
}
//Add Acc
public function addAccessory($id){
    $dv = Device::find($id);
    $provider = DB::table('provider')->get();
    return view('ktv.device.addAcc')->with(['dv'=>$dv,'providers'=>$provider]);
    
}
//save Acc when import device
public function saveAcc(Request $request, $id){
    $dv = Device::find($id);
    $acc = new Accessory;
    $acc->acc_name = $request->accName;
    $acc->unit = $request->unit;
    $acc->provider_id = $request->provider;
    $acc->model = $request->model;
    $acc->serial = $request->serial;
    $acc->amount = $request->accNumber;
    $acc->type = $request->typeAcc;
    $acc->produce_date = $request->produce_date;
    $acc->expire_date = $request->expire_date;
    $acc->import_date = date('Y-m-d');
    $acc->note = $request->note; 
    $acc->used = $request->used;
    $acc->status = 1;

    $acc->save();
    $dv_acc = new Device_accessory;
    $dv_acc->dv_id = $id;
    $dv_acc->acc_id = $acc->id;
    $dv_acc->amount = $request->accNumber;
    $dv_acc->export_date = date('Y-m-d');
    $dv_acc->status = 1;
    $dv_acc->save();
    return redirect()->route('device.getAcc',['id'=>$dv->id])->with(['message'=>'Đã lưu vật tư kèm theo.']);

}
// move device
public function moveDevice(Request $request, $id)
{  
     if($request->get('query'))
        {
            $query = $request->get('query');

            $data = DB::table('users')
            ->where('department_id', '=', $query)
            ->get();
            //dd($data);
            $output = '<option value="">Chọn người phụ trách</option>';
            foreach($data as $row)
            {
               $output .= '<option value="'.$row->user_id.'">'.$row->fullname.'</option>
               ';
           }
           //echo $output;
           return response()->json(['msg'=>$output]) ;
       }else{
     $this->validate($request, [
        'image' => 'max:4096'
    ],
        $messages = [
            'image.max'    => 'Kích thước file vượt quá 4MB.'
        ]
    );
         $device = Device::find($id);
         $group = $device->group;
         $dvType = $device->dv_type_id;
         $dvId = $device->dv_id;
         if($request->hasFile('image')){

            $fname = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $request->file('image');

        
            }
       if($group == 'A'){
        $destinationPath = public_path('/asset/groupA');
       }elseif ($group == 'B') {
           $destinationPath = public_path('/asset/groupB');
       }elseif ($group == 'C') {
           $destinationPath = public_path('/asset/groupC');
       }elseif ($group == 'D') {
           $destinationPath = public_path('/asset/groupD');
       }else{
            $destinationPath = public_path('/asset/groupX');
       }

        $path = $destinationPath. "/".$dvType;
        if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
        }
        $imagePath = $path. "/".  $fname;
        $image->move($path, $fname);
        $device->handover_img = $fname;
      
    $dep = $request->select_dept;
    $dep_name = Department::where(['id' => $dep])->pluck('department_name')->first();
    if($device->department_id){
    $dep_now = Department::where(['id' => $device->department_id])->pluck('department_name')->first();
    }else{
        $dep_now = 'Phòng Vật Tư';
    }

    $name = $device->dv_name;
    $device->status = 1;
    $device->department_id = $request->select_dept;
    $device->handover_date = date('Y-m-d H:i:s');
    $device->save();
    $notice = new Notification;
    $notice->req_content = "Phòng vật tư xác nhận bàn giao thiết bị ".$name." cho khoa ".$dep_name;
    $notice->req_date = Carbon::now();
    $notice->dv_id = $id;
    $notice->dept_now = $request->select_dept;
    $notice->status = 12;
    $notice->annunciator_id = 'Phòng vật tư';
    $notice->receiver = $request->receiver;
    $notice->save();
    //tạo lịch sử điều chuyển
    $his =new History_ktv;
    $his->status = 'mdv'; //mdv = move device
    $his->action = 'Thiết bị được bàn giao từ '.$dep_now.' sang '.$dep_name;
    $his->time = date('Y-m-d');
    $his->dv_id = $dvId;
    $his->implementer = 'Phòng vật tư';
    $his->note = 'Bàn giao sử dụng thiết bị thành công';
    $his->save();

    return redirect()->route('device.show0')->with('message','Đã bàn giao thiết bị thành công');
}
}
//viewImage
public function imageView($id){
    $dv = Device::find($id);
    $i =  $dv->handover_img;
    return view('ktv.device.image')->with('devices',$dv);
}

    //getEditDevice
public function getEditDevice($id){
    $dev = Device::find($id);
    $provider = DB::table('provider')->get();
    $dv_types = DB::table('device_type')->get();
    $accs = DB::table('device_accessory')->where('dv_id',$id)->get();
    $history = DB::table('mainten_schedule')->where('dv_id',$id)->get();
    return view('ktv.device.edit',['dev'=>$dev,'dv_types'=>$dv_types,'providers'=>$provider,'accs'=>$accs,'hiss'=>$history]);
}

public function postEditDevice(Request $request,$id){
    $device = Device::find($id);
    $device->dv_name = $request->name_device;
    $device->dv_model = $request->model;
    $device->dv_serial = $request->serial;
    $device->dv_type_id = $request->device_type;
    $device->manufacturer = $request->produce;
    $device->produce_date = $request->produce_date;
    $device->khbd = $request->khbd;
    $device->khhn = $request->khhn;
    $device->import_id = $request->import_id;
    $device->import_date = $request->import_date;
    $device->price = $request->price;
    $device->note = $request->note;
    $device->group = $request->group;
    $device->country = $request->country;
    $device->provider_id = $request->provider;
    $device->license_number = $request->license_number;
    $device->license_number_date = $request->license_number_date;
    $device->maintain_date = $request->maintain_date;
    $device->save();
    return back()->with('message','Cập nhật thông tin thiết bị thành công');
    //return redirect()->route('device.show0')->with('message','Cập nhật thông tin thiết bị thành công');
}
public function delDevice($id){
    $device = Device::findOrFail($id);
    $dv_name = $device->dv_name;
    $device->delete();    
    return back()->with('message','Đã xóa thiết bị '.$dv_name);
    }
// bàn giao vật tư
public function accessoryDevice(Request $request, $id){
    $acc_dv = Device_accessory::find($id);
    $acc_id = $acc_dv->acc_id;
    $acc = Accessory::find($acc_id);
    $used = $acc->used;
    $sl = strval($acc->amount - $acc->used);
    $amount = (int)$request->amount;
    if($amount <1){
          return redirect()->route('accessory.show')->with(['message'=>'Số lượng vật tư tối thiểu là 1,vui lòng chọn lại số lượng']);
    }
    elseif($amount > $sl){
        return redirect()->route('accessory.show')->with(['message'=>'Số lượng vật tư hiện tại ít hơn '.$amount.',vui lòng kiểm tra lại thông tin vật tư']);
    }else
    {   
        $acc->used = $used + $request->amount;
        $acc->save();
       
        $acc_dv->amount = $request->amount;
        $acc_dv->export_date = $request->export_date;
        $acc_dv->save();
        
        //tạo lịch sử tb
        $his = new History_ktv;
        $his->action = 'Bàn giao vật tư '.$acc->acc_name.' cho thiết bị ';
        $his->status = 'gacc';//gacc = give accessory
        $his->time = $request->export_date;
        $his->dv_id = $request->dv_id;
        $his->implementer = 'Phòng vật tư';
        $his->note = 'Bàn giao vật tư cho thiết bị';
        $his->save();
        return redirect()->route('accessory.show')->with(['message'=>'Bàn giao vật tư thành công!']);
    }
}
     // show history device
public function historyDevice($id){
    $his = DB::table('mainten_schedule')->where('dv_id',$id)->get();
    $dep = Device::find($id);
    return view('ktv.device.history',['his'=>$his,'device'=>$dep]);
}

    //device_type

public function showDvType(Request $request){
    $dv_type = DB::table('device_type')->orderBy('id','desc');
    if($request->dv_group)
    {
        $dv_type = $dv_type->where('dv_group', 'like' , '%'.$request->dv_group.'%');
    }
    if($request->searchName)
    {
        $dv_type = $dv_type->where('dv_type_name', 'like' , '%'.$request->searchName.'%');
    }
    if($request->searchId)
    {
        $dv_type = $dv_type->where('dv_type_id', 'like' , '%'.$request->searchId.'%');
    }
    $dv_type = $dv_type->paginate(10);
    return view('ktv.device_type.list',['dv_types'=>$dv_type]);
}

public function getAddDvType(){
    return view('ktv.device_type.add');
}

public function postAddDvType(Request $request){
    $this->validate($request,[
        'nameDvt' => 'required',
        'idDvt' => 'required|unique:device_type,dv_type_id'
    ],[
        'nameDvt.required' => 'Bạn chưa nhập tên loại thiết bị',
        'idDvt.unique' => 'Mã loại thiết bị đã tồn tại.'
    ]);
    $dv_types = new Device_type;
    $dv_types->dv_type_name = $request->nameDvt;
    $dv_types->dv_type_id = $request->idDvt;
    $dv_types->dv_group = $request->group;
    $dv_types->save();
    return redirect()->route('dvtype.show')->with('message','Thêm thành công loại thiết bị '.$request->nameDvt);
}

public function getEditDvType($id){
    $dv_type = Device_type::find($id);
    return view('ktv.device_type.edit',compact('dv_type'));
}

public function postEditDvType(Request $request, $id){
    
    $dv_types = Device_type::find($id);
   // $dv_types->dv_type_id = $request->idDvt;
    $dv_types->dv_type_name = $request->nameDvt;
    $dv_types->dv_group = $request->group;
    $dv_types->save();
    return redirect()->route('dvtype.show')->with('message','Cập nhật thông tin loại thiết bị thành công.');
}

public function deleteDvType($id){
    $dv_types = Device_type::findOrFail($id);
    $dv_types->delete();    
    return redirect()->route('dvtype.show')->with('message','Đã xóa một loại thiết bị ');
}

    //accessory
public function showAcc(Request $request){
    $acc = DB::table('accessory')->orderBy('id','desc');
    $prov = DB::table('provider')->get();
    $devs = DB::table('device')->where('status',0)->orWhere('status',1)->get();
    if($request->acc_name){
        $acc = $acc->where('acc_name','like','%'.$request->acc_name.'%')->orderBy('id','desc');
    }
    if($request->provider_id){
        $acc = $acc->where('provider_id','=', $request->provider_id)->orderBy('id','desc');
    }
    $acc = $acc->paginate(10);
    return view('ktv.accessory',['accs'=>$acc,'providers'=>$prov,'devs'=>$devs]);

}

public function addAcc(){
    $prov = DB::table('provider')->get();
    return view('ktv.accessory.add',['providers'=>$prov]);
}
//thêm số lượng vật tư đã có
public function plusAcc(Request $request, $id, $user_id){

    $acc = Accessory::find($id);
    $amount =(int)$request->amount;
    $now =$acc->amount + $amount;
    $acc->amount = $now;
    $acc->save();
    $his = new History_ktv;
    $his->time = $request->import_date;
    $his->action = "Nhập thêm số lượng vật tư";
    $his->acc_id =(int)$id;
    $his->implementer = (int)$user_id;
    $his->status = 'acc';
    $his->save();
    return redirect()->route('accessory.show')->with('message','Thêm thành công.');
}
//save ACC when import Acc
public function postAddAcc(Request $request){
    $this->validate($request,[
        'accName'=> 'required',
        'amount' => 'numeric',
    ],[
        'accName.required' =>'Bạn chưa nhập vật tư',
        'amount.numeric' => 'Chỉ nhập số tự nhiên cho trường Số lượng'
    ]);
    $acc = new Accessory;
    $acc->acc_name    = $request->accName;
    $acc->provider_id = $request->provider_id;
    $acc->amount      = $request->amount;
    $acc->import_date = $request->importDate;
    $acc->unit        = $request->unit;
    $acc->model       = $request->model;
    $acc->serial      = $request->serial;
    $acc->expire_date = $request->expire_date;
    $acc->type        = $request->typeAcc;
    $acc->status      = 0;
    $acc->note        = $request->note;
    $acc->produce_date        = $request->produce_date;
    $acc->factory        = $request->factory;
    $acc->save();
    return redirect()->route('accessory.show')->with('Thêm mới vật tư thành công');
}
public function getEditAcc($id){
    $acc = Accessory::find($id);
    $prov = DB::table('provider')->get();
    return view('ktv.accessory.edit',['acc'=>$acc,'providers'=>$prov]);

}
public function postEditAcc(Request $request, $id){
    $this->validate($request,[
        'amount' => 'numeric',
        'used' => 'numeric',
        'broken' => 'numeric'
    ],[
        'amount.numeric' => 'Số lượng phải là số tự nhiên',
        'used.numeric' => 'Số lượng phải là số tự nhiên',
        'broken.numeric' => 'Số lượng phải là số tự nhiên',
    ]);
    $acc = Accessory::find($id);
    $acc->acc_name    = $request->accName;
    $acc->provider_id = $request->provider_id;
    $acc->amount      = $request->amount;
    $acc->model       = $request->model;
    $acc->serial      = $request->serial;
    $acc->import_date = $request->importDate;
    $acc->unit        = $request->unit;
    $acc->expire_date = $request->expire_date;
    $acc->produce_date = $request->produce_date;
    $acc->note        = $request->note;

    $acc->save();
    return redirect()->route('accessory.show')->with('message','Cập nhật thành công thông tin vật tư ');
}
public function delAcc($id){
    $acc = Accessory::findOrFail($id);
    $acc->delete();
    return redirect()->route('accessory.show')->with('Đã xóa thành công một vật tư');

}

public function selectDevice(Request $request, $id){
    // $dvt = DB::table('device_type')
    $accDev = DB::table('device_accessory')->where('acc_id',$id)->get();
    $dev = [];
    if($request->dvId){
        $dev = DB::table('device')->where('dv_type_id','like', '%'.$request->dvt.'%')->get();
    }
    if($request->dvt){
        $dev = DB::table('device')->where('dv_type_id','=', $request->dvt)->get();
    }
    if($request->model){
        $dev = DB::table('device')->where('dv_model','=', $request->model)->get();
    }
    if($request->serial){
        $dev = DB::table('device')->where('dv_serial','=', $request->serial)->get();
    }
    if($request->dept){
        $dev = DB::table('device')->where('department_id','=', $request->dept)->get();
    }

    return view('ktv.accessory.slDevice')->with(['devices'=>$dev,'id'=>$id, 'accDevices'=>$accDev]);
}

public function postSelectDevice(Request $request, $id){
    $sl = $request->selected;
    foreach ($sl as $r) {
        $check = DB::table('device_accessory')->where('acc_id',$id)->where('dv_id',(int)$r)->exists();
        if(!$check){
        $dvAcc = new Device_accessory;
        $dvAcc->acc_id = $id;
        $dvAcc->dv_id = (int)$r;
        $dvAcc->status = 0;
        $dvAcc->save();

        }
    }
    //return redirect()->route('accessory.show')->with('message','Đã lưu thông tin vật tư và thiết bị có thể tương thích.');
    return back()->with('message','Đã lưu thông tin vật tư và thiết bị có thể tương thích.');
}

public function delDeviceAcc($id){
    $dvAcc = Device_accessory::findOrFail($id);
    $dvAcc->delete();
    return back();
}

//xem hồ sơ thiết bị
public function fileDevice($id){
    $device = Device::find($id);
    $dv_id = $device->dv_id;
    $his = History_ktv::where('dv_id',$dv_id)->orderBy('id','asc')->get();
    //$file = History_ktv::where('dv_id',$id)->orderBy('id','asc')->get();
    
    return view('ktv.device.file')->with(['hiss'=>$his,'dv'=>$id,'dv_id'=>$dv_id]);
}

//lịch bảo dưỡng
public function showmaintain(Request $request){
    $devices = Device::where('status','<>' ,4)->orderBy('id','desc');
    $dvt = DB::table('device_type')->get();
    $provider = DB::table('provider')->get();

    if($request->dv_name){
        $devices = $devices->where('dv_name','like','%'.$request->dv_name.'%');
    }
    if($request->model){
        $devices = $devices->where('dv_model','=',$request->model);
    }
    if($request->serial){
        $devices = $devices->where('dv_serial','=',$request->serial);
    }
    if($request->import_id){
        $devices = $devices->where('import_id','like','%'.$request->import_id.'%');
    }
    if($request->dvt_id){
        $devices = $devices->where('dv_type_id','=',$request->dvt_id);
    }if($request->provider){
        $devices = $devices->where('provider_id','=',$request->provider);
    }
    $devices = $devices->paginate(10);
    return view('ktv.device.maintain')->with(['devices'=>$devices,'dvts'=>$dvt,'providers'=>$provider]);
}
    public function createSchedule(){
        $device = DB::table('device')->get();
        return view('ktv.device.schedule')->with('devices',$device);
    }
    public function createScheduled(Request $request, $id){
        $dv = DB::table('device')->where('dv_id',$id)->first();
        $schedule = DB::table('schedule_action')->where('dv_id',$id)->get();
        return view('ktv.device.scheduled')->with(['device'=>$dv,'schedules'=>$schedule]);
    }

    public function postScheduleAct(Request $request){
        $id = $request->sl_dv;
        $act = DB::table('schedule_action')->where('dv_id',$id)->get();
        $schedules = new ScheduleAction;
        $schedules->act_id = count($act) +1;
        $schedules->dv_id = $request->sl_dv;
        $schedules->scheduleAct = $request->nameAct;
        $schedules->scheduleTime = $request->timeAct;
        $schedules->startDate = $request->datebd;
        $schedules->note = $request->note;
        $schedules->save();

        return redirect()->route('device.scheduled',['id'=>$id]);
    }

    public function getEditAct($id){
        $act = ScheduleAction::find($id);
        return view('ktv.device.editAction')->with(['act'=>$act]);
    }
    public function postEditAct(Request $request, $id){
        $act = ScheduleAction::find($id);
        $id = $act->dv_id;
        $act->scheduleAct = $request->actName;
        if($request->fq){
        $act->scheduleTime = $request->fq;
        }
        $act->startDate = $request->startDate;
        $act->note = $request->note;
        $act->save();
        return redirect()->route('device.scheduled',['id'=>$id]);
    }
    public function delScheduleAct($id){
        $sch = ScheduleAction::findOrFail($id);
        $id = $sch->dv_id;
        $sch->delete();
        return redirect()->route('device.scheduled',['id'=>$id]);
    }



    public function maintainCheck(Request $request,$id){
            $ys = date('Y');
            $ms = date('m');
            $time = date('Y-m-d');
        $dev = DB::table('device')->where('dv_id',$id)->first();
        $dv = DB::table('schedule_action')->where('dv_id',$id)->get();
        $ch = CheckMaintain::where('dv_id',$id)->orderBy('id','desc');
        if( $request->timesl){
            $time = $request->timesl;
            $ms = substr($request->timesl, 5,6);
            $ms = substr($ms,0,2);
            // dd($ms);
            $ys = substr($request->timesl, 0,4);
            $ch = $ch->where('year','=',$ys)->where('month','=',$ms)->get();
        }else
        {   

            $ch = $ch->where('year','=',$ys)->where('month','=',$ms)->get();
        }

        return view('ktv.device.maintain_check')->with(['device'=>$dev,'maintainAct'=>$dv,'checked'=>$ch,'ys'=>$ys, 'ms'=>$ms, 'time'=>$time]);
        
    
    }

    //maintain check device
    public function checked(Request $request, $id){
        $act_id = substr($request->id_check, 0,1);
        $check = new CheckMaintain;
            $check->year = $request->nam;
            $check->month = $request->thang;
            $check->dv_id = $request->dv_id;
            $check->act_id = $act_id;
            $check->check_id = $request->id_check;
            $check->time = $request->date_check;
            $check->checker = $request->checker;
            $check->note = $request->note;
            $check->type_check = $request->select_check;
            $check->save();
        // return redirect()->route('device.maintainCheck',['id'=>$request->dv_id]);
            return back();
    }

     //edit checked view
    public function detailCheck(Request $request){
        $detail = DB::table('check')->where('check_id',$request->cid)->first();
        return view('ktv.device.detailCheck')->with('check',$detail);

    }

    //save edit check
    public function editCheck(Request $request, $id){
        $time = Carbon::now();
        $check = CheckMaintain::find($id);
            $d = $check->dv_id;
            $check->year = $time->year;
            $check->time = $request->date_check;
            $check->checker = $request->checker;
            $check->note = $request->note;
            $check->type_check = $request->select_check;
            $check->save();
            //return redirect()->route('device.maintainCheck',['id'=>$d]);
            return back()->with('message',"Đã chỉnh sửa thành công!");
    }
    
    public function viewDevice(Request $request){
        $dvs = Device::where('status',0)->orWhere('status',1)->orWhere('status',2)->orWhere('status',3)->orWhere('status',4)->orWhere('status',5)->orderBy('id','desc');
        $dvt = DB::table('device_type')->get();
        $dept = DB::table('department')->get();
        if($request->dvId){
            $dvs = Device::where('dv_id','like','%'. $request->dvId. '%');
        }
        if($request->model){
            $dvs = Device::where('dv_model','=', $request->model);
        }
        if($request->serial){
            $dvs = Device::where('dv_serial','=',$request->serial);
        }
        if($request->import_id){
            $dvs = Device::where('import_id','like','%'. $request->import_id. '%');
        }
        if($request->dvname){
             $dvs = Device::where('dv_name','like','%'.$request->dvname.'%');
        }
        if($request->dept){ 
            $dvs = Device::where('department_id','=', $request->dept);
            

        }
        if($request->dvt){
            $dvs = Device::where('dv_type_id','=', $request->dvt);
            
        }
        
        $dvs = $dvs->paginate(10);
        return view('ktv.device.viewdv')->with(['devices'=>$dvs,'dvts'=>$dvt,'depts'=>$dept]);
        
        
    }
    //export all device
    public function export(Request $request)
    {   
        $dp = $request->dept;
        $dv = $request->dvt;
        $pr = $request->import_id;


        if( !is_null($dp) || !is_null($dv) || !is_null($pr) )

            {
                $name = time();
                return Excel::download(new DeviceExportQuery($request->dept, $request->dvt, $request->import_id), $name.'.xlsx');
        }else
        {
            
            return Excel::download(new DeviceExport, 'Danh_Sach_Tat_Ca_Thiet_Bi.xlsx');
        }

      
    }
    
    

}


