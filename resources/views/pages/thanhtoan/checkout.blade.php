@extends('layout')
@section('content')

<section id="cart_items">
		<div class="">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active1">THANH TOÁN GIỎ HÀNG</li>
				</ol>
			</div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
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

             <div style="margin: 30px; text-align: center;" ><h3>Chọn hình thức thanh toán</h3></div> 
             <form action="{{URL::to('/order_place')}}" method="POST">
					{{csrf_field() }}               
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả băng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Trả tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox">Chuyển sang Bit coint</label>
					</span>
                    <br>
                    <input type="submit" value="Đặt Hàng" name="send_oder_place" style="background-color: #01DF01 ;">
				</div>
                </form>
		</div>
	</section> <!--/#cart_items-->

@endsection	