@extends('layout')
@section('content')

<section id="cart_items">
<div class="">
        <div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				<li class="active1">HÓA ĐƠN CỦA BẠN</li>
			</ol>
		</div>
<div class="shopper-informations">
<div class="row">
					<div class="col-sm-2 clearfix">
						<div class="bill-to">
							<div class="form-one">
                           		 <form style="background-color: #c98f78bb ; border-radius: 10px;" action="{{url('/check-coupon')}}" method="POST">
								@if(Session::get('cart'))
								@csrf
									<label style="margin-left: 10%;">Nhập mã giảm giá</label>
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
									<input class="btn btn-primary btn-sm" type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính giảm giá">
								@endif
								</form>

								<br>
								<form style="background-color: #c98f78bb ; border-radius: 10px;" >
                             
                                <div class="form-group">
                                    <label style="margin-left: 10%;">Chọn thành phố</label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="margin-left: 10%;">Chọn quận huyện</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label style="margin-left: 10%;">Chọn xã phường</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>
                               
                               
                              	<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                                </form>
							</div>
						</div>
					</div>
<div class="col-sm-10 clearfix">
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
					<a href="{{URL::to('/chitietproduct/'.$cart['product_id'])}}">
						<img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" /></a>
					</td>
					<td class="cart_description">
						<h4>
						<p style="color: #E3EB02;">{{$cart['product_name']}}</p></h4>
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
		</td>
	</td>
</tr>
<tr>

	<td colspan="3">
	<form method="POST">
									@csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Điền email" required>
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên người gửi" required >
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ gửi hàng" required>
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại" required>
									<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5" required></textarea>
									
									@if(Session::get('fee'))
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else 
										<input type="hidden" name="order_fee" class="order_fee" value="10000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif
									
									
									
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="0">Qua chuyển khoản</option>
		                                            <option value="1">Tiền mặt</option>   
		                                    </select>
		                                </div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>					
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
</div>
</div>
</div>
		</div>
	</section> <!--/#cart_items-->

@endsection	