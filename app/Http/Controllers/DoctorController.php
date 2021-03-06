<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Notification;
use App\Device;
use DB;
use App\Device_type;
use App\History_ktv;
use App\Device_accessory;
use PDF;
use Dompdf\Dompdf;


class DoctorController extends Controller
{
    //
    public function index(){
        $notice = Notification::where('status','=',4)->orWhere('status',6)->orWhere('status',8)->orWhere('status',12)->orWhere('status',14)->orderBy('id','desc')->paginate(10);
        //return view('doctor.home',['notices'=>$notice]);
        return view('header_main');
    }

    public function showDev(Request $request, $id){
        $user = User::find($id);
        $dept = DB::table('department')->get();
        $devices = Device::where('status',1)->where('department_id',$user->department_id)->orderBy('id','desc');
        if($request->dv_name){
            $devices = $devices->where('dv_name','like','%'.$request->dv_name.'%');
        }
        if($request->model){
            $devices = $devices->where('dv_model','like','%'.$request->model.'%');
        }
        if($request->serial){
            $devices = $devices->where('dv_serial','like','%'.$request->serial.'%');
        }
        $devices = $devices->paginate(10);
    	return view('doctor.listDevice',['devices'=>$devices,'user'=>$user,'depts'=>$dept]);
    }

     public function fixDev(Request $request, $id){
        $user = User::find($id);
        $devices = Device::where('status',2)->where('department_id','=',$user->department_id)->orderBy('id','desc');
        if($request->dv_name){
            $devices = $devices->where('dv_name','like','%'.$request->dv_name.'%');
        }
        if($request->model){
            $devices = $devices->where('dv_name','like','%'.$request->model.'%');
        }
        if($request->serial){
            $devices = $devices->where('dv_name','like','%'.$request->serial.'%');
        }
        $devices = $devices->paginate(10);
     	return view('doctor.listBroken',['devices'=>$devices,'user'=>$user]);
    }
    //báo điều chuyển thiết bị
     public function moveDev($id){
        $user = User::find($id);
        $dept = DB::table('department')->get();
        $devices = Device::where('status',1)->where('department_id','=',$user->department_id)->get();
        return view('doctor.moveDevice',['devices'=>$devices,'depts'=>$dept]);

    }
    // post thông tin chuyển thiết bị
    public function postMoveDev(Request $request, $id){
            $user = User::find($id);
            $notice = new Notification;
            $notice->req_date = Carbon::now();
            $notice->req_content = $request->reason;
            $notice->annunciator_id = $user->user_id;
            $notice->dept_now = $user->department_id;
            $notice->dept_next = $request->dept_name;
            $notice->dv_id= $request->dv_id;
            $notice->status = 2;
            $notice->receiver = 'Phòng vật tư';
            $notice->save();
            return redirect()->route('doctor.home')->with('message','Đã gửi phiếu điều chuyển tới phòng vật tư.');

    }
    //báo hỏng thiết bị
    public function noticeDev(Request $request,$id){
        $d = $request->user_id;
        $dev = Device::find($id);
        $dev->status = 2;
        $dvname = $dev->dv_name;
        $dev->save();
        $notice = new Notification;
        $notice->req_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->req_content = $request->reason;
        $notice->dv_id = $dev->id;
        $notice->status = 0;
        $notice->annunciator_id = $request->user_id;
        $notice->receiver = 1;
        $notice->save();
        $his = new History_ktv;
        $his->action = 'Thiết bị được báo hỏng';
        $his->time = Carbon::now('Asia/Ho_Chi_Minh');
        $his->dv_id = $dev->dv_id;
        $his->implementer = \App\User::where(['user_id'=>$request->user_id])->pluck('fullname')->first() ;
        $his->note = 'Báo hỏng thiết bị';
        $his->status = 'nbd'; //nb = notice broken device
        $his->save();
        return redirect()->route('doctor.home')->with('message','Đã báo hỏng thiết bị '.$dvname.' thành công.');
    }

    //accept notice from ktv
    public function acceptNotice($id, $user_id){
        $notice = Notification::find($id);
        $stt = $notice->status;
        if( $stt == '4')
        {
        $notice->status = 5;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        $notice->save();
        }
        if($stt == '6')
        {
        $notice->status = 7;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        $notice->save();
        }
        if($stt == '8')
        {
        $notice->status = 9;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        $notice->save();
        }
        if($stt == '12')
        {
        $notice->status = 13;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        $notice->save();
        }
        if($stt == '5'){
            $notice->status = 4;
            $notice->save();
        }
        if($stt == '7'){
            $notice->status = 6;
            $notice->save();
        }
        if($stt == '9'){
            $notice->status = 8;
            $notice->save();
        }
        if($stt == '13'){
            $notice->status = 12;
            $notice->save();
        }
        if($stt == '14')
        {
            $i = $notice->dv_id;
            $dv = DB::table('device')->where('id',$i)->first();
            $dvname = $dv->dv_name;
            $notice->status = 15;
            $notice->save();
            $resp = new Notification;
            $resp->dv_id = $dv->id;
            $resp->req_date = Carbon::now('Asia/Ho_Chi_Minh');
            $resp->req_content = "Đã xác nhận thiết bị ".$dvname." sử dụng tốt";
            $resp->annunciator_id = $user_id;
            $resp->status = 16;
            $resp->save();
        }

        return redirect()->route('doctor.home');
    }

    public function addDevice(Request $request){
        $dvt = DB::table('device_type')->get();
        $dv = Device::where('status',0)->orderBy('id','desc')->get();
        if($request->dvId){
            $dv = $dv->where('dv_id','=',$request->dvId);
        }
        if($request->dvName){
            $dv = $dv->where('dv_name','like','%'.$request->dvName.'%');
        }
        if($request->dvt){
            $dv = $dv->where('dv_type_id','=', $request->dvt);
        }
        return view('doctor.addDevice')->with(['dvs'=>$dv,'dvts'=>$dvt]);
    }
   
    //edit, reset Password,
     public function editDoctor($id){
     	$user = User::find($id);
     	return view('doctor.edit',compact('user'));
    }
     public function postEdit(Request $request, $id){
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
        return redirect()->route('doctor.home')->with('message','Cập nhật thông tin thành công!');
    }
     public function getPsw($id){
     	$user = User::find($id);
     	return view('doctor.resetPsw',compact('user'));
    }

    public function postPsw(Request $request, $id){
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
         return redirect()->route('doctor.home')->with('message','Cập nhật mật khẩu thành công!');
        
    }

    public function print_device($id,$user_id){
        $dv = Device::findOrFail($id);
        $ac = DB::table('device_accessory')->where('dv_id',$id)->get();

        $notice = new Notification;
        $notice->req_content = "Xin bàn giao thiết bị";
        $notice->req_date = Carbon::now();
        $notice->dv_id = $dv->dv_id;
        $notice->annunciator_id = $user_id;
        $notice->status = 0;
        $notice->save();
        $datetime = now();
        $datetime = str_replace(" ", "", $datetime);
        $datetime = str_replace("-", "", $datetime);
        $datetime = str_replace(":", "", $datetime);

        $name = $id. '_' . $datetime;

        $pdf = PDF::loadView("pdf.AD", ['device' => $dv,'acc'=>$ac])->setPaper('A4', 'Portrait');
        //return $pdf->download('AD.pdf');
        $pdf->save(config('app.pdf_export') .$name. ".pdf");
        return response()->file(config('app.pdf_export') .$name. ".pdf");
        // $pdf->save(public_path("pdf_export/".$name.".pdf"));
        //return $pdf->stream('AD.pdf');
        //return response()->file(public_path("pdf_export/".$name.".pdf"));
    }

    public function delNoitce($id){
        $note = Notification::findOrFail($id);
        $note->delete();
        return redirect()->route('doctor.home')->with('message','Đã xóa 1 thông báo');
    }

    public function checkDevice($id){
        $dev = Device::find($id);
        $accs = DB::table('device_accessory')->where('dv_id',$id)->get();
        $history = DB::table('mainten_schedule')->where('dv_id',$id)->get();
    return view('doctor.checkDev',['dev'=>$dev,'accs'=>$accs,'hiss'=>$history]);
    }

}
