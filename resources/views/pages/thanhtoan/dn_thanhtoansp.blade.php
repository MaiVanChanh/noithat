@extends('layout')
@section('content')
<div class="header">
		<div class="header-main">
		       <h1 >ĐĂNG NHẬP</h1>

	<?php
	use Illuminate\Support\Facades\Session ;
	$message = Session::get('message');   
	if($message){
	echo '<p style ="text-aline : center; color: red ; font-size: 15px;"  >'.$message.'</p>';
	Session::put('message',null);
	}
?>


			<div class="header-bottom">
				<div class="header-right w3agile">
					
					<div class="header-left-bottom agileinfo">
						
                    <form action="{{URL::to('/login-customer')}}" method="post">
						{{csrf_field()}}
		@foreach($errors->all() as $val)
		 <ul style="color:red"> 
		 	{{$val}}
		 </ul>
		@endforeach
						<input type="email" class="ggg" name="customer_email"  placeholder="E-MAIL" required="">
						<input type="password" name="customer_password" placeholder="password" required=""/>
						<div class="remember">
			             <span class="checkbox1">
							   <label class="checkbox"><input type="checkbox" name="" checked="">ghi nhớ !</label>
							   <div class="forgot">
						 	<h6><a href="{{URL::to('/quen-mk')}}">Forgot Password?</a></h6>
						 </div>
						 <div>
<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
<br/>
@if($errors->has('g-recaptcha-response'))
<span class="invalid-feedback" style="display:block">
	
</span>
@endif
			</div>
						 </span>
						 
						<div class="clear"> </div>
					  </div>
					   
						<input type="submit" value="Login">
					</form>	
					<div class="header-left-top">
						<div class="sign-up"> <h2>or</h2> </div>
					
					</div>
					<div class="header-social wthree">
							<a href="{{URL::to('/dk_thanhtoan')}}"><h4>ĐĂNG KÝ TÀI KHOẢN</h4></a>
							
						</div>
						
				</div>
				</div>
			  
			</div>
		</div>
</div>

@endsection	