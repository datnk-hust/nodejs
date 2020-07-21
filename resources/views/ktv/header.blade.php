<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <title>Phần mềm quản lý thiết bị y tế</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet"/> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <script src="../assets/js/Chart.bundle.js"></script>
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/app.js"></script>
</head>
<style>
    a{
        text-decoration: none;
    }
</style>
<body>
    <div class="main-wrapper">
        <!-- header -->
        <div class="header">
			<div class="header-left">
				<a href="#" class="logo">
					<img src="../assets/img/logo.png" width="35" height="35" alt=""> <span>Quản lý thiết bị</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">6</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Thông báo</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<!-- <span class="avatar">
												<img alt="John Doe" src="../assets/img/user.jpg" class="img-fluid">
											</span> -->
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bác sĩ A</span> báo hỏng thiết bị<span class="noti-title">máy đo nhịp thở</span></p>
												<p class="noti-time"><span class="notification-time">4 phút trước</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bác sĩ Vân Anh</span> báo hỏng thiết bị <span class="noti-title">monitor phòng số 2</span></p>
												<p class="noti-time"><span class="notification-time">6 phút trước</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="../assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.html">Thông tin tài khoản</a>
						<a class="dropdown-item" href="edit-profile.html">Chỉnh sửa tài khoản</a>
						<a class="dropdown-item" href="settings.html">Cài đặt</a>
						<a class="dropdown-item" href="login.html">Đăng xuất</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <!-- sidebar -->
        <div class="sidebar" id="sidebar">
            
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                    @if(Auth::user()->level_id == 3)
                        <li>
                            <a href="">Danh sách thiết bị</a>
                            <a href="">Điều chuyển thiết bị</a>
                        </li>
                    @else
                        <li>
                            @if( Auth::user()->rule == 1 || Auth::user()->rule == 2)
                            <a href="index.html"><i class="fa fa-dashboard"></i> <span>Trang chủ ktv</span></a>
                            @else
                            <a href="index.html"><i class="fa fa-dashboard"></i> <span>Trang chủ 1</span></a>
                            @endif
                        </li>
                        @if( Auth::user()->rule == 1 )
                        <li>
                            <a href="user.html"><i class="fa fa-user-md"></i> <span>Người dùng</span></a>
                        </li>
                        @endif
                        
                        <li class="submenu">
                            <a href=""><i class="fa fa-delicious"></i> <span>Thiết bị  </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="device.html">Danh sách thiết bị</a></li>
                                <li><a href="deviceRecords.html">Hồ sơ thiết bị</a></li>
                                <li><a href="repair.html">Sửa chữa và bảo dưỡng</a></li>
                                <li><a href="typeDevice.html">Loại thiết bị</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="supplies.html"><i class="fa fa-life-ring"></i> <span>Vật tư</span></a>
                        </li>
                        <li>
                            <a href="khoa_phong.html"><i class="fa fa-hospital-o"></i> <span>Khoa phòng</span></a>
                        </li>
                        <li>
                            <a href="supplier.html"><i class="fa fa-building"></i> <span>Nhà cung cấp</span></a>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
            
        </div>
        <!-- body -->
        <div class="page-wrapper">
            <div class="content">
            <div >
                @if ($errors->any())
                <div class="alert alert-danger" style="text-align: center;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif
                @if (session('message'))
                <div class="alert alert-success" style="text-align: center;">
                    {{ session('message') }}
                </div> 
                @endif
            </div>
            @yield('content')
                <p>Hello</p> 
            </div>
            
            <!-- check error-->
            
        </div>
        
       
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    

</body>
</html>