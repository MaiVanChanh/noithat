@extends('layout')
@section('content')
<div class="header">
		<div class="header-main">
		       <h1 >ĐĂNG KÝ </h1>
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
					<form role="form" action="{{URL::to('/add-customer')}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
						<input type="text" name="customer_name"  minlength="2" maxlength="10" placeholder="Họ và tên "required>	
						<input type="email" name="customer_email"  placeholder="Email "required>
							
						<input type="text" name="customer_phone" pattern="[0-9]{10}"  placeholder="Phone" required>
						<input type="password" name="customer_password"  placeholder="Mật khẩu"required>
						<input type="submit" value="ĐĂNG KÝ">
					</form>	
					<div class="header-social wthree">
							<a href="{{URL::to('/dn_thanhtoan')}}"><h4>ĐĂNG NHẬP</h4></a>
							
						</div>		
				</div>
				</div>
			  
			</div>
		</div>
</div>
	
@endsection	