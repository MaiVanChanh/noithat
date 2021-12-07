
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Login :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>

<div class="log-w3">
<div class="w3layouts-main">
	<h2>Reset mật khẩu </h2>
	<?php
use Illuminate\Support\Facades\Session ;
$message = Session::get('message');
	if($message){
		echo '<span style="width: 100%;">'.$message.'</span>';
		Session::put('message',null);
	}
	?>
		<form action="{{URL::to('reset-admin')}}" method="post">
			{{ csrf_field() }}
		
			<input type="text"  class="ggg" name="admin_email" placeholder="Email" required >
			<input type="tel"  class="ggg" name="admin_phone" placeholder="Phone" required>
			<input type="date"  class="ggg" name="admin_ns" placeholder="Ngày sinh" required>
			<p>Lưu ý : chỉ có leader admin mới thực hiện được chức năng reset</p>
			<p>Admin thường vui lòng liên hệ admin để lấy lại mật khẩu</p>
			<br>
			<h6><a href="{{URL::to('/admin')}}">Đăng Nhập</a></h6>
			<br>
				<input type="submit" value="Reset" name="login">
				<div>


			</div>

		</form>
		
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
