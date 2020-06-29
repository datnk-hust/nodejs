<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('login');
Route::post('/login','HomeController@postLogin')->name('post.login');
//Route::get('/user','HomeController@getHello')->name('get.hello');
Route::get('/logout', 'HomeController@getLogout')->name('get.logout');
Route::get('/admin',function(){
	return view('admin.master');
})->name('get.admin');

//admin 
Route::group(['prefix'=>'admin', 'middleware'=>['CheckLogin','Admin']],function(){
		//admin/user/show
		Route::get('list','adminController@index')->name('show.user');
		Route::get('add','adminController@addUser')->name('add.user');	 
		Route::post('add','adminController@postUser')->name('post.user');
		Route::get('edit/{id}','adminController@getEditUser')->name('edit.user');
		Route::post('edit/{id}','adminController@postEditUser')->name('post.editUser');
		Route::get('delete/{id}','adminController@getDelUser')->name('del.user');
		//department
		Route::get('department/list','adminController@showDepartment')->name('show.department');
		Route::get('department/add','adminController@addDepartment')->name('add.department');
		Route::post('department/add','adminController@postDepartment')->name('post.addDep');
		Route::get('department/edit/{id}','adminController@getEditDep')->name('edit.dep');
		Route::post('department/edit/{id}','adminController@postEditDep')->name('post.dep');
		Route::get('department/delete/{id}','adminController@getDelDep')->name('del.dep');

	});
Route::group(['prefix'=>'ktv','middleware'=> 'CheckLogin'],function(){
		//ktv
		Route::get('Notification','UserController@notice')->name('get.home');
		Route::get('Notification/delete/{id}','UserController@deleteNotification')->name('ktv.delete.notification');
		Route::get('dashboard','UserController@index')->name('get.ktv');
		Route::get('edit/{id}','UserController@getEditKTV')->name('getEdit.ktv');
		Route::post('edit/{id}','UserController@postEditKTV')->name('postEdit.ktv');
		Route::get('edit/password/{id}','UserController@getPswKTV')->name('getPsw.ktv');
		Route::post('edit/password/{id}','UserController@postPswKTV')->name('postPsw.ktv');
		Route::get('accept/notice/{user_id}/{id}/{dv_id}/{status}','UserController@acceptNotice')->name('ktv.acceptNotice');

		//provider
		Route::get('provider/list','UserController@showProvider')->name('show.provider');
		Route::get('provider/add','UserController@getAddProvider')->name('provider.add');
		Route::post('provider/add','UserController@postAddProvider')->name('provider.postAdd');
		Route::get('provider/edit/{id}','UserController@getEditProvider')->name('provider.getEdit');
		Route::post('provider/edit/{id}','UserController@postEditProvider')->name('provider.postEdit');
		Route::get('provider/delete/{id}','UserController@deleteProvider')->name('provider.del');

		//device
		Route::get('device/view/image/{id}','UserController@imageView')->name('device.view.image');
		Route::get('device/list/new','UserController@showDevice0')->name('device.show0');
		Route::get('device/list/used','UserController@showDevice1')->name('device.show1');
		Route::get('device/list/broken','UserController@showDevice2')->name('device.show2');
		Route::get('device/list/fix','UserController@showDevice3')->name('device.show3');
		Route::get('device/list/die','UserController@showDevice4')->name('device.show4');
		Route::post('device/repair/schedule/{id}','UserController@scheduleRepair')->name('device.scheduleRepair');
		Route::get('device/maintain','UserController@showMaintain')->name('device.maintain');
		Route::get('device/add/accessory/{id}','UserController@addAccessory')->name('device.getAcc');
		Route::post('device/save/accessory/{id}','UserController@saveAcc')->name('device.saveAcc');
		Route::get('device/edit/{id}','UserController@getEditDevice')->name('device.getEdit');
		Route::post('device/edit/{id}','UserController@postEditDevice')->name('device.postEdit');
		Route::get('device/add','UserController@getAddDevice')->name('device.getAdd');
		Route::post('device/add/success','UserController@postAddDevice')->name('device.postAdd');
		Route::post('device/move/{id}','UserController@moveDevice')->name('device.move');
		Route::get('device/delete/{id}','UserController@delDevice')->name('device.del');
		Route::post('device/editSchedule/{id}','UserController@editSchedule')->name('device.editSchedule');
		Route::post('device/updateStatus/{id}','UserController@updateStatus')->name('device.updateStatus');
		Route::get('device/history/{id}','UserController@historyDevice')->name('device.history');
		Route::post('device/accessory/{id}','UserController@accessoryDevice')->name('device.accessory');
		Route::get('device/file/{id}','UserController@fileDevice')->name('device.view');
		Route::get('device/create/schedule','UserController@createSchedule')->name('device.schedule');
		Route::get('device/create/schedule/{id}','UserController@createScheduled')->name('device.scheduled');
		Route::post('device/create/schedule','UserController@postScheduleAct')->name('device.postScheduleAct');
		Route::get('device/delete/scheduleAct/{id}','UserController@delScheduleAct')->name('device.delScheduleAct');
		Route::get('device/view/','UserController@viewDevice')->name('device.viewdv');
		Route::get('device/maintain/check/{id}','UserController@maintainCheck')->name('device.maintainCheck');
		Route::post('device/check/{id}','UserController@checked')->name('device.check');
		Route::post('device/edit/check/{id}','UserController@editCheck')->name('device.editcheck');
		Route::get('device/check/detail','UserController@detailCheck')->name('device.detailCheck');
		Route::get('device/edit/actSchedule/{id}','UserController@getEditAct')->name('device.getEditAct');
		Route::post('device/post/edit/act/{id}','UserController@postEditAct')->name('postEditAct.ktv');

		//device_type
		Route::get('device_type/list','UserController@showDvType')->name('dvtype.show');
		Route::get('device_type/add','UserController@getAddDvType')->name('dvtype.getAdd');
		Route::post('device_type/add','UserController@postAddDvType')->name('dvtype.postAdd');
		Route::get('device_type/edit/{id}','UserController@getEditDvType')->name('dvtype.getEdit');
		Route::post('device_type/edit/{id}','UserController@postEditDvType')->name('dvtype.postEdit');
		Route::get('device_type/delete/{id}','UserController@deleteDvType')->name('dvtype.del');

		//accessory
		Route::get('accessory/list','UserController@showAcc')->name('accessory.show');
		Route::get('accessory/add','UserController@addAcc')->name('accessory.add');
		Route::post('accessory/add','UserController@postAddAcc')->name('accessory.postAdd');
		Route::get('accessory/edit/{id}','UserController@getEditAcc')->name('accessory.getEdit');
		Route::post('accessory/edit/{id}','UserController@postEditAcc')->name('accessory.postEdit');
		Route::get('accessory/delete/{id}','UserController@delACC')->name('accessory.del');
		Route::post('accessory/plus/{id}/{user_id}','UserController@plusAcc')->name('accessory.plus');
		Route::get('accessory/mark/device/{id}','UserController@markDevice')->name('acc.markDevice');
		Route::get('accessory/select/device/{id}','UserController@selectDevice')->name('acc.selectDevice');
		Route::post('accessory/post/selected/{id}','UserController@postSelectDevice')->name('acc.postSelectDev');
		Route::get('accessory/del/device/{id}','UserController@delDeviceAcc')->name('del.dv_accessory');

	});
	Route::group(['prefix'=>'doctor'],function(){
		//doctor
		Route::get('/dashboard','DoctorController@index')->name('doctor.home');
		Route::get('/list/device/{id}','DoctorController@showDev')->name('doctor.actDevice');
		Route::get('/list/fix/{id}','DoctorController@fixDev')->name('doctor.fixDevice');
		Route::get('/device/move/{id}','DoctorController@moveDev')->name('doctor.moveDevice');
		Route::get('/device/history/move','DoctorController@historyMoveDev')->name('doctor.historyMoveDev');
		Route::get('/edit/{id}','DoctorController@editDoctor')->name('doctor.getEdit');
		Route::post('/edit/{id}','DoctorController@postEdit')->name('doctor.postEdit');
		Route::get('/password/{id}','DoctorController@getPsw')->name('doctor.getPsw');
		Route::post('/password/{id}','DoctorController@postPsw')->name('doctor.postPsw');
		Route::post('/notification/device/brocken/{id}','DoctorController@noticeDev')->name('doctor.noticeDev');
		Route::get('/notification/accept/{id}/{user_id}','DoctorController@acceptNotice')->name('doctor.acceptNoitce');
		Route::post('/transformer/device/{id}','DoctorController@postMoveDev')->name('doctor.postMoveDev');
		Route::get('add/device','DoctorController@addDevice')->name('doctor.addDevice');
		Route::get('print/device/{id}/{user_id}','DoctorController@print_device')->name('doctor.print.device');
		Route::get('del/notice/{id}','DoctorController@delNoitce')->name('doctor.delNoitce');
		Route::get('check/device/{id}','DoctorController@checkDevice')->name('doctor.checkDevice');
	});
	Route::group(['prefix'=>'export'],function(){
		Route::get('device/all','UserController@export')->name('device.export');
		// Route::get('device/{id}','UserController@exportDvt')->name('device.exportDvt');
		// Route::get('device/{id}','UserController@exportDep')->name('device.exportDep');

	});


