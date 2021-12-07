<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	<title>Nội Thất Kc </title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main2.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <script src="{{asset('public/frontend/js/html5shiv.js')}}"></script>
    <script src="{{asset('public/frontend/js/respond.min.js')}}"></script>

  
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
		<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:0961089798"><i class="fa fa-phone"></i> +096.108.9798</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> maivanchanh@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="logo pull-left">
							<a href="">
							<img src="{{URL::to('public\frontend\images\RubyChanh1.png')}}"  height="130"  alt="" style="position: absolute; margin-top: -50px;"/></a>
						</div>
						<div class="btn-group pull-right">
					<form action="{{URL::to('/tim-kiem')}}" method="POST">
					{{csrf_field() }}
						<div class="search_box pull-right">
						<form id="form"> 
								<input style="border-radius: 10px;" type="search"  name="tim_kiem" placeholder="Search..."  required >
								<button style="border-radius: 10px;" ><img src="{{URL::to('public\frontend\images\searchicon.png')}}"  />	</button>
						</form>
						</div>
					</form>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<?php 
								use Illuminate\Support\Facades\Session ;
								$customer_id = Session::get('customer_id');
								if($customer_id== NULL){
								?>
								<li><a href="{{URL::to('/dn_thanhtoan')}}"><i class="fa fa-unlock"></i> Checkout </a></li>
								<?php
								}else{
									?>
									<li><a href="{{URL::to('/muahang')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
									<?php
								}
								?>
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>


								<?php 
								
								$customer_id = Session::get('customer_id');
								if($customer_id== NULL){
								?>
								<li><a href="{{URL::to('/dn_thanhtoan')}}"><i class="fa fa-unlock"></i> Login </a></li>
								<?php
								}else{
									?>
												
			<li class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" style="width: 140px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">	
			
<?php
$customer_name = Session::get('customer_name');  
echo $customer_name;
?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" style="width: 40px;">
                <li><a href="{{URL::to('/view-customer')}}"><i class=" fa fa-suitcase"></i> Profile</a></li>
                <li><a href="{{URL::to('/editpass-customer')}}"><i class="fa fa-cog"></i> Pass</a></li>
				<li><a href="{{URL::to('/dx_thanhtoan')}}"><i class="fa fa-lock"></i> 
log out  </a></li>
            </ul>
     </li>
	 <?php
$name1= Session::get('customer_image');  
?>
	 <img src="{{URL::to('public/upload/customers/'.$name1)}}" alt="" height="40" width="40" style="border-radius: 40px;" />
	
									<?php
								}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

<div class="container-top"><a href="{{URL::to('/')}}"> <span ></span>Trang chủ</a></div>

<div class="container">
	<div class="mainmenu pull-left">
	
    <nav id="menu" class="menu">
        <ul class="dropdown">
			 @foreach($category as $key =>$cate)
			 <li><a href="{{URL::to('/category/'.$cate->category_id)}}"> <span class="pull-left"></span>{{$cate->category_name}}</a>
                <ul>
				@foreach($material as $key =>$mate)
									<li><a href="{{URL::to('/material/'.$mate->material_id.'/'.$cate->category_id)}}"> {{$mate->material_name}}</a></li>
				@endforeach
                </ul>
             </li>						
			@endforeach
		</ul>
    </nav>
	</div>
</div>
	</header><!--/header-->
	
	<section >
	<div class="mothai">
	<div class="container-top"><a href="{{URL::to('/gioithieu')}}"> <span ></span>Giới thiệu</a></div><br>
	</div>
	
	<div class="container">
				<div class="col-sm-12 padding-right">
					@yield('content')
		</div>
	</div>
	
	</section>
	
	<footer id="footer"><!--Footer-->			
		<div class="button">
		<div style="background-color: #A9A9A9; height: 100%; width: 100%; text-align: center; font-size: 8px;">© MVC</div>F
			<div >
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget1">
						<img src="{{URL::to('public\frontend\images\RubyChanh1.png')}}" alt="" height="220" width="260" />
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Giới thiệu cửa hàng</h2>
							<h5 style="color:#101010;">Nội thất Kc là cửa hàng chuyên kinh doanh về các sản phẩm đồ gỗ nội thất cho gia đình , công ty , trường học .... Với chất liệu từ gỗ gần ngũi với thiên nhiên giúp chúng ta có cảm giác thoải mái và bát mắt hơn .</h5>
							<br>
						<h4 style="text-align: center; background-color: #FFFFFF; font-weight: 656;border-radius: 10px;">
						NỘI THẤT <a>Kc</a>   
<img src="{{URL::to('public\frontend\images\RubyChanh1.png')}}" alt="" height="40" width="50"  /> 
						TRAO TRỌN NIỀM TIN
						</h4>
							
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>DỊCH VỤ mua sắm</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a>Giao hàng tận nhà</a></li>
								<li><a>Tư vấn nhiệt tình</a></li>
								<li><a>Bảo hành nhanh chóng</a></li>
								<li><a>Đóng gói kỹ càng</a></li>
								<li><a>Sản phẩm theo su hướng</a></li>
								<li><a>Giá cả phải chăng</a></li>
								<li><a>Xử lý lỗi nhanh chóng</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Hỗ trợi Khách Hàng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a >Chính sách mua hàng</a></li>
								<li><a >Chính sách giao hàng</a></li>
								<li><a >Chính sách thanh toán</a></li>
								<li><a >Chính sách bảo mật</a></li>
								<li><a >Chính sách cộng tác viên</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h1 style="color: #2F4F4F; ;" >Liên Hệ</h1>
							
								<input type="text" placeholder="Nhập thông tin của bạn " />
								<a href="{{URL::to('/send-mail')}}">Gửi</a>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							
						</div>
<!-- 
facebook -->
					<!-- 	<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FN%25E1%25BB%2599i-Th%25E1%25BA%25A5t-Vi%25E1%25BB%2587t-1701546326565737%2F&amp;tabs=timeline&amp;width=250&amp;height=300&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId=1820925571492394" width="250" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe> -->
					
					</div>
					
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +096.108.9798</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> maivanchanh@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	<div class="fab-wrapper">
   <input id="fabCheckbox" type="checkbox" class="fab-checkbox">
   <label class="fab" for="fabCheckbox">
      <i class="icon-cps-fab-menu"></i>
      <!-- <i class="icon-cps-close"></i> -->
   </label>
<div class="fab-wheel">
      <a class="fab-action fab-action-1" href="https://www.google.com/maps/place/Chung+c%C6%B0+Hi%E1%BB%87p+Th%C3%A0nh+Block+B/@11.0002115,106.6666359,17z/data=!3m1!4b1!4m5!3m4!1s0x3174d1ee421b6ba3:0x43bbc150df3a25b8!8m2!3d11.0002062!4d106.6688246" rel="nofollow" target="_blank">
         <span class="fab-title">Tìm cửa hàng</span>
         <div class="fab-button fab-button-1"><i class="icon-cps-local"></i></div>
      </a>
      <a class="fab-action fab-action-2" href="tel:0961089798 " rel="nofollow">
         <span class="fab-title">Gọi trực tiếp</span>
         <div class="fab-button fab-button-2"><i class="icon-cps-phone"></i></div>
      </a>
      <a class="fab-action fab-action-3" href="https://www.facebook.com/messages/t/100009393901983" target="_blank" rel="nofollow">
         <span class="fab-title">Chat ngay</span>
         <div class="fab-button fab-button-3"><i class="icon-cps-chat"></i></div>
      </a>
      <a class="fab-action fab-action-4" href="https://zalo.me/0367979432 " target="_blank" rel="nofollow">
         <span class="fab-title">Chat trên Zalo</span>
         <div class="fab-button fab-button-4"><i class="icon-cps-chat-zalo"></i></div>
      </a>
   </div>
   <div class="suggestions-chat-box hidden" style="display: none;">
      <div class="box-content d-flex justify-content-around align-items-center">
         <i class="fa fa-times-circle" aria-hidden="true" id="btnClose" onclick="jQuery('.suggestions-chat-box').hide()"></i>
         <p class="mb-0 font-14">Liên hệ ngay <i class="fa fa-hand-o-right" aria-hidden="true"></i></p>
      </div>
   </div>
   <div class="devvn_bg"></div>
</div>

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        load_comment();

        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/load-comment')}}",
              method:"POST",
              data:{product_id:product_id, _token:_token},
              success:function(data){
              
                $('#comment_show').html(data);
              }
            });
        }
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/send-comment')}}",
              method:"POST",
              data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
              success:function(data){
                
                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                load_comment();
                $('#notify_comment').fadeOut(9000);
                $('.comment_name').val('');
                $('.comment_content').val('');
              }
            });
        });
    });
</script>
	
<script type="text/javascript">
     $(document).ready(function() {
        $('#imageGallery').lightSlider({

            gallery:true,
            item:1,
            loop:true,
            thumbItem:3,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }

        });  
      });
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('.send_order').click(function(){
	swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: "{{url('/confirm-order')}}",
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });
	  });
  });

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.add-to-cart').click(function(){
			var id=$(this).data('id_product');
			var cart_product_id = $('.cart_product_id_'+id).val();
			var cart_product_name = $('.cart_product_name_'+id).val();
			var cart_product_image = $('.cart_product_image_'+id).val();
			var cart_product_price = $('.cart_product_price_'+id).val();
			var cart_product_qty = $('.cart_product_qty_'+id).val();
			var _token = $('input[name="_token"]').val();
			$.ajax({

				url: "{{url('/add-cart-ajax')}}",
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						
						swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });
					}
			});
		});
	});
</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : "{{url('/select-delivery-home')}}",
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
	  <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url : "{{url('/calculate-fee')}}",
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload(); 
                    }
                    });
                } 
        });
    });
    </script>
</body>
</html>