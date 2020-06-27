<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Level;
use App\User;
use App\Department;
use Hash;
use Auth;

class adminController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 11; 
        $users = User::latest();
        $deps = User::select('department_id')->groupBy('department_id')->get();
        
        if($request->searchName)
        {
            $users = $users->where('fullname','like','%'.$request->searchName.'%');
        }
        if($request->searchEmail)
        {
            $users = $users->where('email','like','%'.$request->searchEmail.'%');
        }
        if($request->ten_khoa)
        {
            $users = $users->where('department_id','like',$request->ten_khoa);
        }
        $users = $users->paginate($limit);
        return view('admin.listUser')->with( ['users' => $users,'deps'=>$deps]);
    }
 
    public function addUser(){
        $user = User::all();
        $levels = Level::all();
        $dep = Department::all();
        return view('admin.addUser',compact('user','levels','dep'));
    }

    public function postUser(Request $request){
      $this->validate($request,
        [
            'email'=>'required|email|unique:users,email',
            'psw'=>'required|min:5|max:20',
            'psw-repeat' => 'required|same:psw',
            'rule'=>'required',
            'user_id'=>'unique:users,user_id'
        ],
        [   'email.required' => 'Bạn chưa nhập email',
            'email.unique'=>'Email đã có người sử dụng!',
            'psw.min'=>'Mật khẩu ít nhất 5 kí tự!',
            'psw.max'=>'Mật khẩu tối đa 20 kí tự!',
            'psw.required'=>'Bạn chưa nhập password',
            'psw_repeat.same'=>'Mật khẩu xác nhận không đúng',
            'user_id.unique'=>'Mã người dùng đã tồn tại.'
        ]);
      $user = new User;
      $user->user_id = $request->user_id;
      $user ->fullname = $request->fullname;
      $user ->password = Hash::make($request->psw);
      $user ->mobile = $request->phone;
      $user ->email = $request->email;
      $user ->address = $request->address;
      $user ->rule = $request->rule;
      $user ->department_id = $request->dep;
      $user->save();
      return redirect()->route('add.user')->with('message','Thêm một người dùng thành công.');
  }

  public function getEditUser($id){
    $dep = Department::all();
    $user = User::find($id);
    return view ('admin.editUser',['user'=>$user,'deps'=>$dep]);
}
    public function postEditUser(Request $request,$id)
{
    $limit = $request->limit ? $request->limit : 11; 

    $this->validate($request,
        [
            'psw-repeat' => 'same:psw',
        ],
        [
            'psw.min'=>'Mật khẩu ít nhất 5 kí tự!',
            'psw.max'=>'Mật khẩu tối đa 20 kí tự!',
            'psw_repeat.same'=>'Mật khẩu xác nhận không đúng'
        ]);
    $user = User::find($id);
    $user ->fullname = $request->fullname;
    $user ->password = Hash::make($request->psw);
    $user ->mobile = $request->phone;
    $user ->address = $request->address;
    $user ->department_id = $request->dep;
    $user->save();
    return redirect()->route('show.user')->with('message', 'Chỉnh sửa thành công');
}
    public function getDelUser($id){
    $users = User::findOrFail($id);
    $users->delete();    
    return redirect()->route('show.user')->with(['message'=>'Xóa một người dùng thành công','users'=>$users]);
}
//department
    public function showDepartment(Request $request){
        $dep = Department::latest();   
        if($request->searchName)
        {
            $dep = $dep->where('department_name','like','%'.$request->searchName.'%');
        }
         $dep = $dep->paginate(11);  
        return view('admin.listDepartment', ['deps'=>$dep]);
    }
    public function getEditDep($id){

        $dep = Department::find($id); 
        return view ('admin.editDep',['dep'=>$dep]);
    }

    public function postEditDep(Request $request, $id){
       
        $dep = Department::find($id);
        $dep ->department_name = $request->depName;
        $dep ->address = $request->address;
        $dep->save();
        return redirect()->route('show.department')->with( 'message','Đã sửa thành công.');
    }

    public function addDepartment(){
        return view('admin.addDep');
    }
    public function postDepartment(Request $request){
        $this->validate($request,
        [
            'depName'=>'required|unique:department,department_name',
        ],
        [
            'depName.unique'=>'Đã tồn tại khoa phòng này!',
        ]);
      $dep = new Department;
      $dep ->department_name = $request->depName;
      $dep ->address = $request->address;
      $dep->save();
      return redirect()->route('add.department')->with('message','Thêm một khoa phòng thành công.');
    }
    public function getDelDep($id){
        DB::table('department')->where('id', $id)->delete();
    return redirect()->route('show.department')->with('message','Đã xóa một khoa phòng');
    }

    
}
