@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
<div style=" margin-top: 10px;">
<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a style="border-radius: 5px;" href="{{ url()->previous() }}">Quay lại</a></li>
				<li class="active1">GIỚI THIỆU</li>
			</ol>
</div>
</div>


  
<div class="product-details"><!--product-details-->
								<div class="col-sm-9"  >
    <h3><center> CỬA HÀNG ĐỒ GỖ NỘI THẤT KC </center></h3>
    <p>Là một trong những cơ sở chuyên sản xuất các vật dụng nội thất uy tín và chất lượng hàng đầu tại Việt Nam, Nội Thất Đồ Gỗ KC là sự lựa chọn HOÀN HẢO cho quý khách hàng có nhu cầu đặt mua các sản phẩm nội thất gỗ (Tủ quần áo, bàn ghế gỗ, kệ đựng tivi, bàn làm việc, bàn thờ,.....) để “trang trí” cho ngôi nhà, văn phòng công ty hoặc khách sạn.</p> 
<h3>TẦM NHÌN</h3>
    <ul >
	<li><P> Xây dựng thương hiệu Nội Thất Đồ Gỗ KC dựa theo 3 tiêu chí: “CHUYÊN NGHIỆP - NGHỆ THUẬT - NHÂN VĂN”</P></li>
	<li><P>Nội Thất Đồ Gỗ KC sở hữu đội ngũ thiết kế giỏi giang, có nhiều ý tưởng độc đáo kết hợp với thợ thủ công hơn 10 năm kinh nghiệm, chắc chắn sẽ đem lại sản phẩm nội thất gỗ khiến khách hàng hài lòng nhất. Đó chính là sự CHUYÊN NGHIỆP mà công ty Nội Thất Đồ Gỗ KC cam kết sẽ thực hiện được.</P></li>
	<li><P>Dù là bàn ghế, tủ quần áo, kệ đựng tivi hay bộ bàn ăn, bàn trang điểm, bàn thờ,.... của công ty chúng tôi điều thể hiện được giá trị cũng như tinh thần NGHỆ THUẬT. Từ bề ngoài tinh xảo cho đến các ứng dụng đa năng, đem lại vô số tiện ích tuyệt vời cho quý khách hàng.</P></li>
	<li><P>Tính NHÂN VĂN của Nội Thất Đồ Gỗ KC ở chỗ tuyệt đối không sử dụng hàng kém chất lượng để “lừa tình” quý khách. Chất lượng gỗ tốt, không pha tạp chất, mong muốn của chúng tôi là mang đến cho các gia đình việt các sản phẩm gỗ chất lượng tương ứng với mức chi phí mà bạn bỏ ra.</P></li>
</ul>
<h3>XU HƯỚNG</h3>
<ul >
	<li><P>Luôn luôn nỗ lực, tạo nên các sản phẩm TỐT NHẤT, giá cả HỢP LÝ nhất, khách hàng sẽ có nhiều sự LỰA CHỌN hơn khi đến với chúng tôi.</P></li>
	<li><P>Nội Thất Đồ Gỗ KC có xưởng gỗ riêng, bán trực tiếp các sản phẩm của mình, không đi qua bất kỳ một khâu trung gian nào, cho nên giá cả HỢP LÝ là điều dĩ nhiên. Quý khách hàng có thể so sánh, cùng chất liệu gỗ, cùng thiết kế, chi phí sản phẩm tại chúng tôi thường thấp hơn 5-15% so với thị trường.</P></li>
	<li><P>Một sản phẩm nội thất như thế nào mới gọi là TỐT NHẤT? Là chất lượng của sản phẩm được đánh giá cao? Bề ngoài phù hợp tính thẩm mỹ của khách hàng? Giá trị nghệ thuật cũng như tính ứng dụng hoàn hảo? Thật sự lý tưởng thì mà các sản phẩm của chúng tôi tập hợp đầy đủ các yếu tố trên.</P></li>
	<li><P>Nội Thất Đồ Gỗ KC cung cấp đầy đủ các sản phẩm nội thất, bao gồm phòng khách, phòng ngủ, nhà bếp, phòng thờ, trẻ em,.... chủ chốt nhất là phòng khách và phòng ngủ, tổng cộng có hơn 10.000 mẫu mã khác nhau, tập hợp đủ phong cách (cổ điển, hiện đại, tân cổ điển) để quý khách hàng có nhiều sự LỰA CHỌN hơn.</P></li>
</ul>


								</div>
                                <div class="col-sm-3">
							<div class="product-information1"><!--/product-information-->
                            <p ><center     style="color:#F6B833;">LẤY MÃ GIẢM GIÁ</center> </p>
     @php 
          $i = 0;
    @endphp
    
                            @foreach($product1 as $key => $pro)		
    @php 
            $i++;
    @endphp
         				
                                
                            <p><b> {{$i}}:Thời gian:</b> <a href="{{URL::to('/show-gioithieu/'.$pro->gioithieu_id)}}">{{$pro->created_at}}</a></p>
							<p><b style="margin-left: 15px;">Tên trang :</b> <a href="{{URL::to('/show-gioithieu/'.$pro->gioithieu_id)}}"> {{$pro->gioithieu_name}}</a></p>
                                @endforeach
							</div>
						</div>
					
</div>

@endsection			
