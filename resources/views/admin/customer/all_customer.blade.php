@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
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
      <table class="table table-striped b-t b-light"  id="table_id">
        <thead>
          <tr>
            <th>Stt
            </th>
            <th>Tên </th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>trạng thái</th>
           
          </tr>
        </thead>
        @php 
          $i = 0;
          @endphp
    <tbody>
    @foreach($customer as $key => $cus)
    @php 
            $i++;
    @endphp
         
            
              <tr>
              <td><i>{{$i}}</i></label></td>
                <td>{{ $cus->customer_name}}</td>
                <td>{{ $cus->customer_email}}</td>
                <td>{{ $cus->customer_password}}</td>
                <td>{{ $cus->customer_phone}}</td>
                <td><span class="text-ellipsis">
              <?php
              if( $cus->customer_note==0){
              ?>
             <a href="{{URL::to('/an-customer/'.$cus->customer_id)}}"><span class="fa-thumb-styling fa fa-unlock text-success text-active"></span></a>
              <?php
              }
              else
              {
                ?>
                <a href="{{URL::to('/hien-customer/'.$cus->customer_id)}}"><span class="fa-thumb-styling fa fa-lock "></span></a>
              <?php
              }
              ?>

            </span></td>
              
              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-customer')}}">Xuất data khách hàng</a>
    </div>
    
  </div>
</div>
@endsection