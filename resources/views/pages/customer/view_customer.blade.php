
@extends('layout')
@section('content')

		<section id="cart_items">
<div class="">
        <div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				<li class="active1">THÔNG TIN NGƯỜI DÙNG</li>
			</ol>
		</div>
<div class="shopper-informations">
<div class="row">
			
<div class="col-sm-12 clearfix">

	<div class="table-responsive cart_info">
		<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
			    		<td  style="text-align: center;">ĐỔI THÔNG TIN NGƯỜI DÙNG </td>
						<td></td>
						<td style="text-align: center; color: white;">ẢNH ĐẠI ĐIỆN</td>
					</tr>
        <?php
             use Illuminate\Support\Facades\Session ;
            $message = Session::get('message');   
            if($message){
            echo ' <tr class="cart_menu"> <td style="background-color: wheat; color :#000"><p type ="text-aline : center;" >'.$message.'</p></td></tr>';
            Session::put('message',null);
            }
        ?>
				</thead>



		@foreach($view_customer as $key => $cate)
          <form role="form" action="{{URL::to('/update-customer/'.$cate->customer_id)}}" method="post" enctype="multipart/form-data">
          <tr>
          {{csrf_field()}}
		  <tr>
		<td> <center>
			<div style="width: 300px;">
			<label for="exampleInputEmail1" style="color: #fff;">Họ và Tên</label>
                                    <input type="text" minlength="2" maxlength="12"  name="customer_name" class="form-control input-sm m-bot15" value="{{$cate->customer_name}}"  required>
			<label for="exampleInputEmail1"  style="color: #fff;">Địa chỉ mail</label>
                                    <input type="email" name="customer_email" class="form-control input-sm m-bot15" value="{{$cate->customer_email}}"  required>
            <label for="exampleInputEmail1"  style="color: #fff;">Năm Sinh</label>
                                    <input type="date" name="customer_ns" class="form-control input-sm m-bot15" value="{{$cate->customer_ns}}"  required>
           <label for="exampleInputPassword1"  style="color: #fff;">Giới tính :</label>
                                    <select name= "customer_gt" class="form-control input-sm m-bot15">
									<?php
                                        if($cate->customer_gt==0){
                                            echo ' 
                                            <option value="0">Nữ</option>
                                            <option value="1">Nam</option>
                                            <option value="2">Khác</option>';
                                        }
                                        elseif($cate->customer_gt==1 ){
                                            echo ' <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                            <option value="2">Khác</option>';
                                        }
                                        else{
                                            echo '
                                            <option value="2">Khác</option>
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>';
                                        }
                                     ?>
                                    </select>
            <label for="exampleInputEmail1"  style="color: #fff;">Điện thoại</label>
                                    <input type="tel" name="customer_phone" class="form-control input-sm m-bot15" pattern="[0-9]{10}" value="{{$cate->customer_phone}}"  required>
			<label for="exampleInputEmail1" style="color: #fff;">Địa Chỉ</label>
                                    <input type="text" minlength="6" name="customer_dc" class="form-control input-sm m-bot15" value="{{$cate->customer_dc}}"  required>
				</div>
				</center>
		</td>
		<td>
		<center>
			<div class="col-sm-1">
					<h2 class="or" style="margin-left: 25px;">AND</h2>      
			</div>
		</center>
		</td>
		<td>
		<center>
			<div >
					<div class="login-form">
						<img src="{{URL::to('public/upload/customers/'.$cate->customer_image)}}" height="250" width="250">   
						<input type="file" name="customer_image" class="form-control" id="exampleInputEmail1"    >
					</div>
					<button type="submit" style=" margin-top: 30px; margin-bottom: 20px;" class="btn btn-default">Update</button>
					<button type="submit" style="margin-left: 20%; margin-top: 30px; margin-bottom: 20px;" class="btn btn-default">
					<a href="{{URL::to('/editpass-customer')}}" ><i class="fa fa-key"></i> Edit Pass</a>
					</button>
					
			</div>
		</center>
		</td>
			</tr>
			
		</form>
		@endforeach
		</center>
			</td>
			</tr>
            </tbody>
		</table>
	</div>
   
</div>
</div>
</div>
		</div>
	</section> <!--/#cart_items-->
@endsection	


















