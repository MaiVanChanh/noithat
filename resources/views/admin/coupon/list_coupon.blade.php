@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Danh sách mã giảm giá
    </div>
    <div class="table-responsive">
                      <?php
                      use Illuminate\Support\Facades\Session ;
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table id="table_id" class="display">
    <thead>
        <tr>
            <th>stt</th>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <!-- <th>Số lượng giảm giá</th> -->
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            <th></th>
        </tr>
    </thead>
    @php 
          $i = 0;
          @endphp
    <tbody>
    @foreach($giamgia as $key => $cou)
    @php 
            $i++;
    @endphp
        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <!-- <td>{{ $cou->coupon_time }}</td> -->
           
            <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
                Giảm theo %
                <?php
                 }else{
                ?>  
                Giảm theo tiền
                <?php
               }
              ?>
            </span>
          </td>
             <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
                Giảm {{$cou->coupon_number}} %
                <?php
                 }else{
                ?>  
                Giảm {{$cou->coupon_number}} VNĐ   
                <?php
               }
              ?>
            </span></td>
            <td>
             
              <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
        </tr>
    @endforeach
    </tbody>
    
</table>











    </div>
   
  </div>
</div>
@endsection