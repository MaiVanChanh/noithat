<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
{
	public function Kiemtra()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
           Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }
    public function insert_couponcode(Request $request){
        $data = $request-> all();
    	$giamgia = new Coupon();
    	$giamgia->coupon_name = $data['coupon_name'];
    	$giamgia->coupon_number = $data['coupon_number'];
    	$giamgia->coupon_code = $data['coupon_code'];
    	// $giamgia->coupon_time = $data['coupon_time'];
    	$giamgia->coupon_condition = $data['coupon_condition'];
    	
		$coupon_code1 = $data['coupon_code'];
        $result = DB::table('tbl_coupon')->where('coupon_code',$coupon_code1)->get();
        if($result){
            $login_count=$result->count();
            if($login_count>0)
                {
					Session::put('message','Mã giảm giá đã có Xin nhập mã khác');
					return Redirect::to('insert-coupon');
				}
			else{
					$giamgia->save();
					Session::put('message','Thêm mã giảm giá thành công');
					return Redirect::to('insert-coupon');
			 }   

			}
      else{
		
		Session::put('message','Lỗi thêm mã giảm giá');
		return Redirect::to('insert-coupon');
      }         
}
	public function list_coupon()
	{	$this->Kiemtra();
		$giamgia = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.coupon.list_coupon')->with(compact('giamgia'));
	}
	public function delete_coupon($coupon_id){
		$this->Kiemtra();
		$giamgia = Coupon::find($coupon_id);
    	$giamgia->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
	}
}
