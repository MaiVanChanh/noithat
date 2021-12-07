
@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
<div style=" margin-top: 10px;">
<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				<li class="active1">CHI TIẾT GIỚI THIỆU</li>
			</ol>
</div>
</div>


  
<div class="product-details"><!--product-details-->
								<div  style="background-color: dimgray; color:floralwhite">
                                @foreach($product2 as $key => $pro1)					
                                {!!$pro1->gioithieu_status!!}
                                @endforeach
								</div>
                              
							
</div>

@endsection			
