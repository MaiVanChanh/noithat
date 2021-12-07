@extends('layout')
@section('content')
@foreach($chitiet as $key => $value)
								<div class="product-details"><!--product-details-->
								<div class="col-sm-5">
<style type="text/css">
		.lSSlideOuter .lSPager.lSGallery img {
			 display: block;
			 height: 140px;
			  max-width: 100%;
		}
		li.active {
		  border: 2px solid #FE980F;
	}	
</style>
									<ul id="imageGallery">
										@foreach($gallery as $key => $gal)
											<li data-thumb="{{asset('public/upload/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/upload/gallery/'.$gal->gallery_image)}}" >
											<img width="100%" alt="{{$gal->gallery_name}}"  src="{{asset('public/upload/gallery/'.$gal->gallery_image)}}" />
											</li>
										@endforeach
									</ul>

								</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><center>{{$value->product_name}}</center></h2>
								<p>ID: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									@csrf
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                          
								<span>
									<span><center>{{number_format($value->product_price,0,',','.').'VNĐ'}}</center></span>
								<br>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" max="5" class="cart_product_qty_{{$value->product_id}}"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
								</span>
								<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
								</form>

								<p><b>Tình trạng:</b> <a>Còn hàng</a></p>
								<p><b>Điều kiện:</b> <a>Mơi 100%</a></p>
								<p><b>Thương hiệu:</b><a> {{$value->material_name}}</a></p>
								<p><b>Danh mục:</b><a> {{$value->category_name}}</a></p>
								
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#reviews" data-toggle="tab">Bình luận </a></li>
								<li ><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết mô tả</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane " id="details" >
								<p style=" color:floralwhite">{!!$value->product_desc!!}</p>
								
							</div>
							
							<div class="tab-pane" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
						
							</div>
							<div class="tab-pane fade active in" id="reviews" >
						<div class="col-sm-12">					
<div class="row style_comment">
	<div class="col-md-6">
		<i class="fa fa-user"></i>
			Comment
	</div>
	<div class="col-md-6" >
		<p style="color:#000;" ><i class="fa fa-clock-o"></i>Add comment</p>
	</div>

</div><p></p>
									<style type="text/css">
										.style_comment {
										    border: 1px solid #ddd;
										    border-radius: 10px;
										    background: #F0F0E9;
										}
									</style>
													
<div class="row style_comment1">
	<div class="col-md-6" style="text-align: center;">
	<form>
										 @csrf
										<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
										 <div id="comment_show"></div>
									
	</form>		
	</div>
	<div class="col-md-6">
		<form action="#">
										<span>
											<input style="width:100%;margin-left: 0" type="text" class="comment_name" placeholder="Tên Hiển thị"/>
												
										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
										<div id="notify_comment"></div>
										
										<button type="button" class="btn btn-default pull-left send-comment">
											Gửi bình luận
										</button>

			</form>
	</div>
	

</div>
								
								</div>
							</div>
						
							
						</div>
					</div><!--/category-tab-->
	@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active" >
							@foreach($lienquan1 as $key => $lienquan)
									<div class="col-sm-2" >
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center">
			<form>
				@csrf
            <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
            <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">          
          
            <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
            <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
            <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
								<a href="{{URL::to('/chitietproduct/'.$lienquan->product_id)}}">
		                        <img src="{{URL::to('/public/upload/product/'.$lienquan->product_image)}}" alt="" height="100" width="100"/>
		                        <h2>{{number_format($lienquan->product_price).' '}}</h2>
		                        <p style="height:40px;color:white;font-size: 12px;">{{$lienquan->product_name}}</p>	
								</a>
				<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
			</form>
		                                        </div>
		                                      
                                			</div>
										</div>
									</div>
							@endforeach		
								
								</div>
									
							</div>
									
						</div>
					</div><!--/recommended_items-->
<footer class="panel-footer">
      <div class="row">
        <div class="col-sm-7 text-right text-center-xs">                
		  {!!$lienquan1->links()!!}
        </div>
      </div>
 </footer>

@endsection