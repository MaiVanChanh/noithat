@extends('layout')
@section('content')
<div class="header">
		<div class="header-main">
		       <h1 >LẤY LẠI MẬT KHẨU</h1>

               @if(session()->has('message'))
				<div class="alert alert-success">
					{!! session()->get('message') !!}
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{!! session()->get('error') !!}
				</div>
				@endif
			<div class="header-bottom">
				<div class="header-right w3agile">
					
					<div class="header-left-bottom agileinfo">
						
         <form action="{{URL::to('reset-customer')}}" method="post">
		 {{ csrf_field() }}
						<input type="text" name="customer_name"  placeholder="Họ Tên  "required=""/>	
						<input type="email" name="customer_email"  placeholder="Email "required=""/>
						<input type="text" name="customer_phone" pattern="[0-9]{10}"  placeholder="Phone" required=""/>	 

						<input type="submit" value="Xác Nhận">
						<div class="header-social wthree">
							<a href="{{URL::to('/dn_thanhtoan')}}"><h4>ĐĂNG NHẬP</h4></a>
							
						</div>

		</form>
				</div>
				</div>
			  
			</div>
		</div>
</div>

@endsection	