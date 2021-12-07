@extends('layout')
@section('content')

<section id="cart_items">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				  <li class="active1">GIỎ HÀNG CỦA BẠN  </li>
				</ol>
			</div>
	@if(session()->has('message'))
        <div class="alert alert-success">
             {!! session()->get('message') !!}
        </div>
    @elseif(session()->has('error'))
            <div class="alert alert-danger">
            {!! session()->get('error') !!}
        </div>
    @endif
			<div class="table-responsive cart_info">

				<form action="{{url('/update-cart')}}" method="POST">
					@csrf
		


				<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="description">Tên sản phẩm</td>
						<td class="price">Giá sản phẩm</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Thành tiền</td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
							
	@if(Session::get('cart')==true)
			@php
				$total = 0;
			@endphp
		@foreach(Session::get('cart') as $key => $cart)
			@php
				$subtotal = $cart['product_price']*$cart['product_qty'];
				$total+=$subtotal;
			@endphp

			<tr>
					<td class="cart_product">
						<img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
					</td>
					<td class="cart_description">

						<h2>{{$cart['product_name']}}</h2>
					</td>

					<td class="cart_price">
						<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
					</td>
					<td class="cart_quantity">
						<div class="cart_quantity_button">
						<form action="{{url('/update-cart')}}" method="POST">
						@csrf
						<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" style="width: 40px;" >
						
						</div>
					</td>
					<td class="cart_total">
						<p class="cart_total_price">
							{{number_format($subtotal,0,',','.')}}đ
						</p>
					</td>
					<td class="cart_delete">
						<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
					</td>
			</tr>
		@endforeach
<tr>				
	<td  colspan="2"> 
								<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default check_out">
								</form>
								<a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a>
	</td>
	<td  colspan="2"> 
	<form action="{{url('/check-coupon')}}" method="POST">
						@csrf
							<input style="width: 200px;" type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá" required><br>
							<input style="margin-left:14%;" type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính giảm giá">
						</form>
	</td>
	
	<td colspan="2" class="mony">
								<li>Tổng giá sản phẩm <span>{{number_format($total,0,',','.')}}VNĐ</span></li>
		@if(Session::get('fee'))
		<li>	
			<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
				Phí vận chuyển 
			<span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
		</li> 
		@endif 

		@if(Session::get('coupon'))
			<li>					
				@foreach(Session::get('coupon') as $key => $cou)
					@if($cou['coupon_condition']==1)			
						<a class="cart_quantity_delete" href="{{url('/unset-coupon')}}">
						<i class="fa fa-times"></i></a>
							Mã giảm 
						<span>{{$cou['coupon_number']}} %</span>
								<p>
									@php 
										$total_coupon = ($total*$cou['coupon_number'])/100;
									@endphp
								</p>
								<p>	
									@php 
										$total_after_coupon = $total-$total_coupon;
									@endphp
								</p>
					@elseif($cou['coupon_condition']==2)
						<a class="cart_quantity_delete" href="{{url('/unset-coupon')}}">
						<i class="fa fa-times"></i></a>
							Mã giảm 
						<span>{{number_format($cou['coupon_number'],0,',','.')}} k</span>
								<p>
									@php 
									$total_coupon = $total - $cou['coupon_number'];
									@endphp
								</p>
									@php 
										$total_after_coupon = $total_coupon;
									@endphp
					@endif
				@endforeach
			</li>
		@endif 
										<li style="font-size: 19px; color:#1c03fa;">Tổng Tiền:
										@php 
											$total_after_fee = $total + Session::get('fee');
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').'đ';
											}

										@endphp
										</li>
										<br>
					<p >
						@if(Session::get('customer_id'))
	                        <a class="btn btn-default check_out" style="margin-left:25%;" href="{{url('/muahang')}}">Thanh Toán giỏ hàng </a>
						@else 
							<a class="btn btn-default check_out" style="margin-left:25%;" href="{{url('/dn_thanhtoan')}}">Đăng Nhập Thanh Toán </a>
						@endif
					</p>
						
					</td>
	</td>
</tr>

		@else 
			<tr>
				<td colspan="5" style="font-size: 29px; color: teal;"><center>
					@php 
						echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
					@endphp
				</center></td>
			</tr>
		@endif
							</tbody>
							</>
						</table>
		</div>	
</section>
@endsection