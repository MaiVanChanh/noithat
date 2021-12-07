
       
@extends('layout')
@section('content')
<section id="cart_items">
<div class="">
        <div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				<li class="active1">ĐỖI MẬT KHẨU</li>
			</ol>
		</div>
<div class="shopper-informations">
<div class="row">
			
<div class="col-sm-8 clearfix">

	<div class="table-responsive cart_info">
		<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
			    		<td  style="text-align: center;">ĐỔI MẬT KHẨU CỦA BẠN </td>
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
			<tbody>
			<tr>
			<td >
            <center>
            @foreach($view_customer as $key => $cate)
   <form action="{{URL::to('/editpass1-customer/'.$cate->customer_id)}}" method="post">
			{{ csrf_field() }}
     <p style="background-color: wheat;">Tài Khoản :{{$cate->customer_name}}</p> 
        <br> <p style="color: wheat;"> Nhập mật khẩu cũ</p>
     
      <input type="password" style="width:300px ;"class="ggg1" name="customer_password1" placeholder="Password" required ><br><br>
      <p style="color: wheat;">Nhập mật khẩu mới</p>
      <input type="password" style="width:300px ;" minlength="6"class="ggg1" name="customer_password2" placeholder="Password" required ><br><br>
      <p style="color: wheat;"> Nhập lại mật khẩu </p>
      <input type="password"style="width:300px ;" minlength="6" class="ggg1" name="customer_password3" placeholder="Password" required ><br><br>
      
				<input type="submit" value="Update" name="login">
				</div>
                @endforeach
                </center>
			</td>
			</tr>
            </tbody>
		</table>
	</div>
   
</div>
<div class="col-sm-4 clearfix">
						<div class="bill-to">
							<div class="form-one">
                           		 <form >
								
								<p style="text-align: center; background-color: white; font-size: 18">THÔNG TIN NGƯỜI DÙNG</p>
								
								</form>
                                @foreach($view_customer as $key => $cate)
								<br>
								<form style="background-color: #c98f78bb ; border-radius: 10px;" >
                                <div class="form-group" style="text-align: center;">
                                    
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <p >Tên : {{ $cate->customer_name}}</p>
                                </div>
                                <div class="form-group">
                                <p >Phone : {{ $cate->customer_phone}}</p>
                                    </select>
                                </div>
                                  <div class="form-group">
                                  <p>Gmail : {{ $cate->customer_email}}</p>   
                                    </select>
                                </div>
                                <div class="form-group">
                                <p >Sinh Ngày: {{ $cate->customer_ns}}</p>
                                    </select>
                                </div>
                                  <div class="form-group">
                                  <p>Giới Tính :  <?php
                                        if($cate->customer_gt==0){
                                            echo 'Nữ';
                                        }
                                        elseif($cate->customer_gt==1 ){
                                            echo 'Nam';
                                        }
                                        else{
                                            echo 'khác';
                                        }
                                     ?></p>   
                                    </select>
                                    
                                </div>
                                <div  class="form-group" style="text-align: center; background-color: #DEDB33;">
                                <a href="{{URL::to('/view-customer')}}" ><i class="fa fa-suitcase"></i> Xem Thêm</a>
                                </div>
                               
                                </form>
                                @endforeach
							</div>
						</div>
					</div>
</div>
</div>
		</div>
	</section> <!--/#cart_items-->

@endsection	

   