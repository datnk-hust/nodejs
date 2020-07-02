<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Quản Lý Trang Thiết Bị Y Tế</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
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
    

    <!------ Include the above in your HEAD tag ---------->
</head>
<style>
    body {
        padding-top: 50px;
        background-color: #f2f2f2;
        font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;

    }

    /* To Dropdown navbar dropdown on hover */
    .navbar-nav > li:hover > .dropdown-menu {
        display: block;
        background-color: #00BD9C;
    }
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
        background-color: #00BD9C;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }
    .dropdown-toggle{
        cursor: pointer;
        font-size: 20px;
    }
    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;

    }
    ul>li>a {
        font-size: 17px;
    }
    .dropdown-submenu.pull-left {
        float: none;
        font-size: 17px;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
        font-size: 17px;
    }

</style>
<body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#00BD9C; font-weight: bold; font-size: 20px; position: fixed;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('doctor.home')}}" style="font-size: 20px;">Trang chủ</a>
                <ul class="nav navbar-nav navbar-left">
                    <li><a  class="dropdown-toggle" data-toggle="dropdown">Danh sách thiết bị</a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="{{route('doctor.actDevice',['id'=>Auth::id()])}}">Thiết bị đang hoạt động</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('doctor.fixDevice',['id'=>Auth::id()]) }}">Thiết bị đang báo hỏng</a></li>
                        </ul></li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="dropdown-toggle" data-toggle="dropdown">  {{ Auth::user()->fullname }} <b class="caret"></b></a>
                         <ul class="dropdown-menu multi-level">
                            <li><a href="{{ route('doctor.getEdit', ['id' => Auth::id()]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Cập nhật thông tin</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('doctor.getPsw',['id' => Auth::id()]) }}"><i class="fa fa-key" aria-hidden="true"></i>
                            Đổi mật khẩu</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('get.logout')}}"><i class="fa fa-power-off" aria-hidden="true"></i>
                            Đăng xuất</a></li>
                        </ul></li><!--<b class="caret"></b>-->
                    </ul>
                    <ul class="nav navbar-nav">
                        <li ><a class="dropdown-toggle" data-toggle="dropdown" style="background-color:#00BD9C;">Bàn giao và Điều chuyển TB </a>
                          <ul class="dropdown-menu multi-level">
                            <!-- <li><a href="{{route('doctor.addDevice') }}">Phiếu bàn giao thiết bị</a></li>
                            <li class="divider"></li> -->
                            <li><a href="{{route('doctor.moveDevice',['id' => Auth::id()]) }}">Phiếu điều chuyển thiết bị</a></li>

                            </ul>
                        </li>
                    </ul>
                    
            </div>
        </div>
    </div>
    <br>
    <div class="container1" style="padding-top: 5px;">
        <div style="max-width: 50%; text-align: center; ">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
             <div class="alert alert-success">
                 {{ session('message') }}
            </div> 
        @endif
        </div>
        @yield('content')
    </div>
</body>