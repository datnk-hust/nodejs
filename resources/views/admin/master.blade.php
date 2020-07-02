<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
body {
   font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
}
/**/

/* Fixed sidenav, full height */
.sidenav {
  height: 94%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 40px;
  left: 0;
  background-color: #0B173B;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 18px;
  color: white;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover,.dropdown-container a:hover {
  color: #A4A4A4;
}

/* Main content */
.main {
  margin-left: 250px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
  position: absolute;
  top: 40px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: #0B173B;
  color: white;
  
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #0B243B;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}
 
 .logout{
  position: fixed;
  top: 7px;
  left:95.5%;
  cursor: pointer;
 }
 .header{
  position: fixed;
  top: 0;
  left: 0;
  border: 0;
  width: 100%
   }
   .container {
    width: 100%;
    font-size: 17px;
   }
/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.admin{
  color: black; 
  text-decoration: none;
}
.admin:hover{
  color: white;
  text-decoration: none;
}
.logout {
  font-size: 18px;
}
</style>


</head>
<body>
  <div class="header">
    <table style="background-color: #04B4AE; width: 100%;height: 40px;">
      <tr>
        <td width="10%" style="text-align: center;font-size: 22px;"><i class="fa fa-fw fa-home"></i><a href="{{route('get.admin')}}"  class="admin">ADMIN</a></td>
        <td ><a href="{{route('get.logout')}}"><button class="logout" ><i title="Đăng xuất" class="fa fa-fw fa-user"></i></button></a></td>
      </tr>
    </table></div>
<div>
<div class="sidenav">
  <button class="dropdown-btn"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Quản Lý Người Dùng
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="{{route('show.user')}}"><i class="fa fa-user-md" style="font-size:18px"></i>&nbsp;&nbsp;Danh sách người dùng</a>
    <a href="{{route('add.user')}}"><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;&nbsp;Thêm người dùng</a>
  </div>
  <button class="dropdown-btn"><i class="fa fa-hospital-o" style="font-size:20px"></i>&nbsp;&nbsp;Quản Lý Khoa Phòng 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="{{route('show.department')}}"><i class="fa fa-table" aria-hidden="true"></i>&nbsp;&nbsp;Danh sách khoa phòng</a>
    <a href="{{route('add.department')}}"><i class="fa fa-eyedropper" aria-hidden="true"></i>
&nbsp;&nbsp;Thêm khoa phòng</a>
  </div>

  <button class="dropdown-btn"><i class="fa fa-medkit" aria-hidden="true" style="font-size: 20px;"></i>&nbsp;&nbsp;Quản Lý Thiết Bị
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="{{route('device.viewdv')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;&nbsp;Hồ sơ thiết bị</a>
    <a href="{{route('device.getAdd')}}"><i class="fa fa-plus-square" aria-hidden="true"></i></i>
&nbsp;&nbsp;Thêm thiết bị</a>
  </div>
  
</div>
<!-- Noi dung tran web-->
<div class="main">
  @yield('content')
</div>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html> 
