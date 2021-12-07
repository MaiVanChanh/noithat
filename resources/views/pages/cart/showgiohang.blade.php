@extends('layout')
@section('content')
<section id="cart_items">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active1">GIỎ HÀNG CỦA BẠN </li>
				</ol>
			</div>
			<div style="height: 20px; background-color: #90e8b5;">
			<?php

use Illuminate\Support\Facades\Session;

$message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
$error = Session::get('error');
                            if($error){
                                echo '<span style="color: red;">'.$error.'</span>';
                                Session::put('error',null);
                            }
                            ?>
			</div>
		
			<div class="table-responsive cart_info">
                
<?php
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
$content = FacadesCart::content();
?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh </td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
						@foreach($content as $v_content)
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}" width="50" height="60" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Mã sp:{{' '.$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price,0,',','.').' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
			<form action="{{URL::to('/update-gio')}}" method="POST">
				{{csrf_field()}}
<input class="cart_quantity_input1" type="text" name="quantity1" value="{{$v_content->qty}}" >
<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart1" >
<input type="submit" value="Chỉnh" name="update_qty1" class="btn1">
			</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php
								$sumtien = $v_content->price*$v_content->qty;
								echo number_format($sumtien,0,',','.').' '.'VNĐ';
								?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-gio/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> 
	<section id="do_action">
				<div class="col-sm-4" style="margin-left: 65%; margin-top: -100px; ">
					<div class="total_area">
						<ul>
							<li>Tổng giá <span>{{FacadesCart::pricetotal(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Thuế sản phẩm<span>{{FacadesCart::tax(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng Thanh Toán<span>{{FacadesCart::total(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Tổng tiền :<span>{{FacadesCart::pricetotal(0,',','.')}}VNĐ</span></li>
							@if(Session::get('coupon'))
							<li>
								
									@foreach(Session::get('coupon') as $key => $cou)
										@if($cou['coupon_condition']==1)
											Mã giảm : {{$cou['coupon_number']}} %
											<p>
												@php 
												$total_coupon = (100*$cou['coupon_number'])/100;
												echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</li></p>';
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format(100-$total_coupon,0,',','.')}}đ</li></p>
										@elseif($cou['coupon_condition']==2)
											Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
											<p>
												@php 
												$total_coupon = 100 - $cou['coupon_number'];
								
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}}đ</li></p>
										@endif
									@endforeach
								


							</li>
							@endif 
						{{-- 	<li>Thuế <span></span></li>
							<li>Phí vận chuyển <span>Free</span></li> --}}
						</ul>
						<?php 
								
								$customer_id = Session::get('customer_id');
								if($customer_id== NULL){
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/dn_thanhtoan')}}">Đăng nhập Thanh Toán</a>
								<?php
								}else{
									?>
									<a class="btn btn-default check_out" href="{{URL::to('/muahang')}}">Thanh Toán</a>

									<?php
								}
								?>
						<ul>
						</ul>							
					</div>
					
				</div>
				<div class="col-sm-3" style="margin-left: 42.7%; margin-top: -374px;">
					<div class="total_area">
						<ul>
						<form method="POST" action="{{url('/check-magiamgia')}}">
											@csrf
												<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
				                          		<input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá">
				                          	
			                          		</form>
						</ul>
												
					</div>
					
				</div>
				
		</div>
	</section><!--/#do_action-->

@endsection	