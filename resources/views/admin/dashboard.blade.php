@extends('admin_layout')
@section('admin_content')
<div class="container-fluid" style="background-color:rgba(215, 221, 224, 0.596);">
			<style type="text/css">
				p.title_thongke {
				    text-align: center;
				    font-size: 20px;
				    font-weight: bold;
				}
			</style>


<p class="title_thongke">TỔNG QUAN VỀ TRANG QUẢN TRỊ</p><br><br><br>
<div class="row">

	<div class="col-md-4 col-xs-12">
		
		<div id="donut-example"></div>	
		<p class="title_thongke">Thống kê người dùng</p>
	</div>

	<!--------------------------->

	<div class="col-md-4 col-xs-12">

	<div id="myfirstchart" style="height: 350px;"></div>
	<p class="title_thongke">Thống kê sản phẩm</p>
		
	</div>

	<div class="col-md-4 col-xs-12">
		<div id="donut-example1"></div>	
		
	<p class="title_thongke">Thống kê đơn hàng</p>	
	</div>
</div>
<div style="  margin-top: 10px;margin-bottom: 10px;  border: 1px dashed green;">
	<center><a></a></center>
</div>
<div class="row">
	<style type="text/css">
		table.table.table-bordered.table-dark {
		    background: #FFEFD5;
		}
		table.table.table-bordered.table-dark tr th {
		    color: #000000;
		}
	</style>

<p class="title_thongke">Thống kê truy cập</p>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Đang online</th>
      <th scope="col">Tổng tháng trước</th>
      <th scope="col">Tổng tháng này</th>
      <th scope="col">Tổng một năm</th>
      <th scope="col">Tổng truy cập</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<td>{{$visitor_count}}</td>
      <td>{{$visitor_last_month_count}}</td>
      <td>{{$visitor_this_month_count}}</td>
      <td>{{$visitor_year_count}}</td>
      <td>{{$visitors_total}}</td>
    </tr>
   
  </tbody>
</table>

</div>


</div>

<script type="text/javascript">
    $(document).ready(function(){
      
        var donut = Morris.Donut({
          element: 'donut-example',
          resize: true,
          colors: [
            '#a8328e',
            '#61a1ce',
            '#ce8f61',
            '#f5b942',
            '#FF4500'
            
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"Tổng Khách hàng", value:<?php echo  $not_customer  ?>},
            {label:"Tổng Admin", value:<?php echo  $not_admin  ?>},
            {label:"Admin Boss", value:<?php echo  $not_admin1  ?>},
            {label:"Admin", value:<?php echo  $not_admin2  ?>},
            {label:"Tài khoản khách hành bị khóa", value:<?php echo  $not_customer1 ?>},
          ]
        });
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      
        new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: 'Tổng sản phẩm', value:<?php echo  $not_product  ?>},
    { year: 'Tổng Danh mục', value:<?php echo $not_category  ?> },
    { year: 'Tổng Chất liệu', value: <?php echo $not_material  ?> },
    { year: 'Tổng Mã Giảm giá', value:<?php echo $not_coupon ?> },
    { year: 'Tổng Trang Giới thiệu', value: <?php echo $not_introduce ?> }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      
        var donut = Morris.Donut({
          element: 'donut-example1',
          resize: true,
          colors: [
            '#FFD700',
            '#00FF00',
            '#008B8B',
            '#FF4500',
            
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"Tổng Đơn hàng", value:<?php echo  $not_order ?>},
            {label:"Đơn Hàng chưa duyệt ", value:<?php echo  $not_order1  ?>},
            {label:"Đơn Hàng đã giao", value:<?php echo  $not_order2 ?>},
            {label:"Đơn hàng bị hủy", value:<?php echo $not_order3  ?>},
          
          ]
        });
        });
</script>
@endsection
