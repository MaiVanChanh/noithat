<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Slider;
use Dotenv\Validator;
use App\Rules\Captcha;
use App\Models\Ship;
use App\Models\City;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

class ThanhtoanController extends Controller
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
/*lưu giỏ hàng */
    public function confirm_order(Request $request){
        $data = $request->all();

         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

  
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;
      
         date_default_timezone_set('Asia/Ho_Chi_Minh');
               
         $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
         
         $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');;
         $order->created_at = $today;
         $order->order_date = $order_date;
         $order->save();
         

         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
         }
         Session::forget('coupon');
         Session::forget('fee');
         Session::forget('cart');
    }
/*phí ship*/
    public function del_fee(){
       Session::forget('fee');
        return redirect()->back();
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Ship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                       Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
/*end phí ship*/

    public function dn_thanhtoan(){
       
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        return view('pages.thanhtoan.dn_thanhtoansp')->with('category',$cate)->with('material',$mate);
    }
    public function dk_thanhtoan(){
         $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        return view('pages.thanhtoan.dk_thanhtoansp')->with('category',$cate)->with('material',$mate);
    }
    public function add_customer(Request $request)
    {
        // $data = array();
        // $customer_phone = $request->customer_phone;
        // $customer_email = $request->customer_email;
        // $data ['customer_name'] = $request->customer_name;
        // $data ['customer_phone'] = $request->customer_phone;
        // $data ['customer_email'] = $request->customer_email;
        // $data ['customer_password'] = md5($request->customer_password);
        $data = $request->all();
        $customer_phone = $request->customer_phone;
        $customer_email = $request->customer_email;
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_note = 0;
        $customer->customer_password = md5($data['customer_password']);

        $result=DB::table('tbl_customers')->where('customer_phone',$customer_phone)->orWhere('customer_email',$customer_email)->first();
        
        if($result){
            $count=$result->customer_phone;
            $count1=$result->customer_email;
            if($count== $customer_phone )
                { 
                    Session::put('message','Số điện thoại '.$customer_phone.'đã có người dùng vui lòng nhập số khác');
                    return Redirect::to('/dk_thanhtoan');
                 }
            elseif($count1== $customer_email )
                { 
                    Session::put('message','Gmail '.$customer_email.'đã có người dùng vui lòng nhập gmail khác');
                    return Redirect::to('/dk_thanhtoan');
                 }
            else{
                  
                    Session::put('message','Chúng tôi đang gặp trục trặc vui lòng quay lại sau');
                    return Redirect::to('/dk_thanhtoan');
                }
           }
        else{
             
            $customer->save();
            Session::put('message','Đăng ký tài khoản thành công');
            return Redirect::to('/dn_thanhtoan');
        }



    }
    public function muahang()

    {
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        $city=City::orderby('matp','ASC')->get();
        return view('pages.thanhtoan.muahang')->with('category',$cate)->with('material',$mate)->with('city',$city); 
    } 
    public function save_muahang(Request $request)
    {
        $data = array();
        $data ['muahang_name'] = $request->muahang_name;
        $data ['muahang_phone'] = $request->muahang_phone;
        $data ['muahang_email'] = $request->muahang_email;
        $data ['muahang_diachi'] = $request->muahang_diachi;
        $data ['muahang_note'] = $request->muahang_note;
      
        $muahang_id = DB::table('tbl_muahang')->insertGetId($data);
        Session::put('muahang_id',$muahang_id);
        return Redirect::to('/checkout');
    }
    public function checkout()
    {
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
       return view('pages.thanhtoan.checkout')->with('category',$cate)->with('material',$mate); 
    }
    public function dx_thanhtoan()
    {
       Session::flush();
       return Redirect::to('/dn_thanhtoan');

    }
    public function dangnhap(Request $request)
    {
        $data = $request->validate([
            'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
         ]);
       $email= $request->customer_email;
        $password = md5 ($request->customer_password);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            if($result->customer_note==0){
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_image',$result->customer_image);
            return Redirect::to('/');
            }
            else{
                Session::put('message', 'Tài khoản của bạn đã bị khóa vui lòng liên hệ 0367979432 để mở khóa!!!');
                return Redirect::to('/dn_thanhtoan');
            }
            
        }
        else{
            Session::put('message', 'Email or Password Invalid');
            return Redirect::to('/dn_thanhtoan');
        }
        
    }
    public function order_place(Request $request)
    {
        
        //insert thanhtoan
        $data = array();
        $data ['thanhtoan_method'] = $request->payment_option;
        $data ['thanhtoan_status'] = 'Đang chờ xửa lý';
        $thanhtoan_id= DB::table('tbl_thanhtoan')->insertGetId($data);
       //insert order
        $order_data = array();
        $order_data ['customer_id'] = Session::get('customer_id');
        $order_data ['muahang_id'] = Session::get('muahang_id');
        $order_data ['thanhtoan_id'] = $thanhtoan_id;
        $order_data ['order_total'] = Cart::pricetotal(0,',','.');
        $order_data ['order_status'] = 'Đang chờ xửa lý';
        $order_id= DB::table('tbl_order')->insertGetId($order_data);
      
        //insert order_detail
        $content = Cart::content();
        foreach($content as $v_content){
        $order_d_data ['order_id'] = $order_id;
        $order_d_data ['product_id'] = $v_content->id;
        $order_d_data ['product_name'] = $v_content->name;
        $order_d_data ['product_price'] = $v_content->price;
        $order_d_data ['product_quantity'] = $v_content->qty;
        DB::table('tbl_order_details')->insertGetId($order_d_data);
        }
        if($data['thanhtoan_method']==1){
            echo 'Thanh toán thẻ atm';
        }
        elseif($data['thanhtoan_method']==2){
            Cart::destroy(); 
            $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
            $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
           return view('pages.thanhtoan.thanhcong')->with('category',$cate)->with('material',$mate); 
        }
        else{
            echo 'Thanh toán Bitcoint';
        }
      
    }
    public function manage_order()
    {
        $this->Kiemtra();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_thanhtoan','tbl_order.thanhtoan_id','=','tbl_thanhtoan.thanhtoan_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_thanhtoan.*')
        ->orderby('tbl_order.order_id','desc')->get();
        $manage_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manage_order);
    }
    public function view_order($orderId)
    {
        $this->Kiemtra();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_muahang','tbl_order.muahang_id','=','tbl_muahang.muahang_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_muahang.*','tbl_order_details.*')->first();
        
        $manger_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manger_order_by_id);
        
    }
    public function viewcustomer()
    {   
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        $customer_id = Session::get('customer_id');
        $view = DB::table('tbl_customers')->where('customer_id',$customer_id)->get();
       
        return view('pages.customer.view_customer')->with('category',$cate)->with('material',$mate)->with('view_customer',$view); 
    }
    public function update_vieworder(Request $request, $id){
       
        $data = array();
        $data ['order_status'] = $request->order_status;
        $ktr=DB::table('tbl_order')->where('order_id',$id)->get();
        if($ktr){
            
            DB::table('tbl_order')->where('order_id',$id)->update($data);
            Session::put('message','Cập nhật thành công');
            return Redirect::to('/manage_order');
        }
     
        Session::put('message','Chỉnh sửa thất bại ');
        return Redirect::to('/manage_order');
    }
}
