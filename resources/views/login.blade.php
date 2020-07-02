<!DOCTYPE html>
<html lang="en">
<head>
<title>WEBSITE QUẢN LÝ THIẾT BỊ Y TẾ</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style type="text/css">
body{
  font-family: TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif;
  background-image: url(./asset/nen.png);
  margin: 0 auto 0 auto;  
  width:100%; 
  text-align:center;
  margin: 20px 0px 20px 0px;   
}
@media only screen and (max-width: 600px) {
  body {
    background-color: lightblue;
  }
}
p{
  font-size:12px;
  text-decoration: none;
  color:#ffffff;
}

h1{
  font-size:1.5em;
  color:#525252;
}

.box{
  background:white;
  max-width:350px;
  border-radius:6px;
  padding: 20px;
  border: #2980b9 4px solid; 
  margin-left: 550px;
  margin-top: 300px;
  max-height: 400px;
  
}

.email{
  background:#ecf0f1;
  border: #ccc 1px solid;
  border-bottom: #ccc 2px solid;
  padding: 8px;
  width:250px;
  color:#AAAAAA;
  margin-top:10px;
  font-size:1em;
  border-radius:4px;
}

.password{
  border-radius:4px;
  background:#ecf0f1;
  border: #ccc 1px solid;
  padding: 8px;
  width:250px;
  font-size:1em;
}

.btn{
  background:#2ecc71;
  width:125px;
  padding-top:5px;
  padding-bottom:5px;
  color:white;
  border-radius:4px;
  border: #27ae60 1px solid;
  
  margin-top:20px;
  margin-bottom:20px;
  margin-left:16px;
  font-weight:900;
  font-size:20;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
      color: #fff;
      background-color: #00cca8;
      border-color: #00cca8;
    }

.btn:hover{
  background:#2CC06B; 
}

#btn2{
  float:left;
  background:#3498db;
  width:125px;  padding-top:5px;
  padding-bottom:5px;
  color:white;
  border-radius:4px;
  border: #2980b9 1px solid;
  
  margin-top:20px;
  margin-bottom:20px;
  margin-left:10px;
  font-weight:800;
  font-size:0.8em;
}

#btn2:hover{ 
background:#3594D2; 
}
</style>
<body>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>


<form method="post" action="{{url('/login')}}">
	@csrf
   
<div class="box">
   @if(isset($message))
  <div role="alert" class="alert alert-danger form-signin-alert" style="color: red;font-size: 9; height: 60px;">Username or password is incorrect.</div>
@php unset($message) @endphp
@endif

<h1>PLEASE LOGIN</h1>
<div style="margin-top: 20px;"><input type="email" name="email" placeholder="email" class="form-control" style="width: 300px;" /></div><br>
<div><input style="width: 300px;" type="password" name="password" placeholder="password" class="form-control" /></div>
  
<div><button type="submit" class="btn btn-primary" style="font-size: 20px; padding: 5px;height: 50px;">Sign In</button></div><!-- End Btn -->
<div style="font-size: 15px;margin-top: 10px;font-weight: bold;">WEBSITE QUẢN LÝ THIẾT BỊ Y TẾ</div>
 <a style="font-size: 11px;color: black;font-weight: bold;margin-top: 3px;">&copy;Copy right by SET-BME 2020</a>
</div> <!-- End Box -->
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
</body>
</head>