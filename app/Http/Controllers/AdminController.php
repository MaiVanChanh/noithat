<?php
/* admin */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Introduce;
use App\Models\Login;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use Dotenv\Validator;
use App\Rules\Captcha;
use Carbon\Carbon;
use App\Models\Visitors;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Str;

session_start();
/*  echo '<pre>';
 print_r($);
 echo '</pre>';
 */
class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(Request $request){
        
        $this->Kiemtra();
        $user_ip_address = $request->ip();  

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
            //total last month
        $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get(); 
        $visitor_last_month_count = $visitor_of_lastmonth->count();
    
            //total this month
        $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get(); 
        $visitor_this_month_count = $visitor_of_thismonth->count();
    
            //total in one year
        $visitor_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get(); 
        $visitor_year_count = $visitor_of_year->count();
    
            //total visitors
        $visitors = Visitors::all();
        $visitors_total = $visitors->count();
    
            //current online
        $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();  
        $visitor_count = $visitors_current->count();
    
        if($visitor_count<1){
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
    
            //total 
        // thống kê sản phẩm
        $not_product = Product::all()->count();
        $not_category = Category::all()->count();
        $not_material = Material::all()->count();
        $not_coupon = Coupon::all()->count();
        $not_introduce = Introduce::all()->count();
        // thống kê đơn hàng
        $not_order = Order::all()->count();
        $not_order1 = Order::all()->where('order_status','1')->count();
        $not_order2 = Order::all()->where('order_status','2')->count();
        $not_order3 = Order::all()->where('order_status','3')->count();
        // thống kê người dùng 
          $not_customer = Customer::all()->count();
          $not_admin = Admin::all()->count();
          $not_customer1 = Customer::all()->where('customer_note','1')->count();
          $not_admin1 = Admin::all()->where('admin_note','0')->count();
          $not_admin2 = Admin::all()->where('admin_note','1')->count();

        return view('admin.dashboard')->with(compact('visitors_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count','not_product','not_category','not_material','not_coupon','not_introduce','not_order','not_order1','not_order2','not_order3','not_customer','not_customer1','not_admin','not_admin1','not_admin2'));
    }  
    public function dashboard(Request $request){

        $data = $request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
           'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
        ]);
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
       $result = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
       if($result){
        $login_count=$result->count();
        if($login_count>0)
            {
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_note',$result->admin_note);
                Session::put('admin_id',$result->admin_id);
                Session::put('admin_image',$result->admin_image);
                return Redirect::to('/dashboard');
                }
            }
        else{
            Session::put('message', 'Email or Password Invalid');
            return Redirect::to('/admin');
        }
    }
   
    public function logout(){
        $this->Kiemtra();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    public function view(){
        $this->Kiemtra();
        $admin_id = Session::get('admin_id');
        $view = DB::table('tbl_admin')->where('admin_id',$admin_id)->get();
        $hienthi = view('admin.view_admin')->with('view_admin',$view);
        return view('admin_layout')->with('admin.view_admin',$hienthi);
    
    }
    public function editadmin($id){
        $this->Kiemtra();
        $edit = DB::table('tbl_admin')->where('admin_id',$id)->get();
        $hienthi = view('admin.edit_admin')->with('edit_admin',$edit);
        return view('admin_layout')->with('admin.edit_admin',$hienthi);
    
    }
    public function  deleteadmin($id){
        $this->Kiemtra();
       
                
        DB::table('tbl_admin')->where('admin_id',$id)->delete();
        Session::put('message','xóa thành công');
        return Redirect::to('/users');
    
    }
   
    public function editpass()
    {
        $this->Kiemtra();
        $admin_id = Session::get('admin_id');
        $view = DB::table('tbl_admin')->where('admin_id',$admin_id)->get();
        $hienthi = view('admin.edit_pass')->with('edit_pass',$view);
        return view('admin_layout')->with('admin.edit_pass',$hienthi);
    }
    public function editmkadmin($id)
    {
        $this->Kiemtra();
        $token_random = Str::random();
        DB::table('tbl_admin')->where('admin_id',$id)->update(['admin_password'=>md5($token_random)]);
        Session::put('message','Đây là mật khẩu mới vui lòng nhắc nhở admin đăng nhập và thay đổi mk : '. $token_random.'');
        return Redirect::to('/users');
    }
    public function updatepass(Request $request, $id)
    {
        $this->Kiemtra();
        $data = $request->validate([
            'admin_password1' => 'required',
            'admin_password2' => 'required',
            'admin_password3' => 'required',
        ]);
        $admin_password = md5($data['admin_password1']);
        $admin_password2 = md5($data['admin_password2']);
        $admin_password3 = md5($data['admin_password3']);
        $result = DB::table('tbl_admin')->where('admin_id',$id)->where('admin_password',$admin_password)->get();
        if($result){
            $login_count=$result->count();
            if($login_count>0)
                {
                    if($admin_password2==$admin_password3){
                        DB::table('tbl_admin')->where('admin_id',$id)->update(['admin_password'=>$admin_password2]);
                        Session::put('message','Update thành công');
                        return Redirect::to('edit-pass');
                    }
                    else{
                        Session::put('message','lỗi mật khẩu mới không trùng');
                        return Redirect::to('edit-pass');
                            }   
                    }
             else{
                Session::put('message','lỗi mật khẩu cũ không đúng');
                return Redirect::to('edit-pass');
                    }         
                }
       
      
    }
    public function updateadmin(Request $request, $id){
        $this->Kiemtra();
        $data = array();
        $data ['admin_name'] = $request->admin_name;
        $data ['admin_ns'] = $request->admin_ns;
        $data ['admin_gt'] = $request->admin_gt;
        $data ['admin_phone'] = $request->admin_phone;
        $data ['admin_email'] = $request->admin_email;
        $data ['admin_dc'] = $request->admin_dc;
        $data ['admin_noilv'] = $request->admin_noilv;
       
        $get_image =$request-> file('admin_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images',$new_image);
            $data['admin_image']=$new_image;
            DB::table('tbl_admin')->where('admin_id',$id)->update($data);
            Session::put('message','Chỉnh sửa thành công');
            return Redirect::to('view-admin');
        }
        DB::table('tbl_admin')->where('admin_id',$id)->update($data);
        Session::put('message','Chỉnh sửa thành công');
        return Redirect::to('view-admin');
    }
    // customer admin
    public function ancustomer ($id)
    {
        $this->Kiemtra();
        DB::table('tbl_customers')->where('customer_id',$id)->update(['customer_note'=>1]);
        Session::put('message','Khóa Người dùng');
        return Redirect::to('customer');
    }
    public function hiencustomer($id)
    {
        $this->Kiemtra();
        DB::table('tbl_customers')->where('customer_id',$id)->update(['customer_note'=>0]);
        Session::put('message','Cho phép người dùng hoặt động ');
        return Redirect::to('customer');
    }
    public function print_customer(){
		$this->Kiemtra();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_customer_convert());
		return $pdf->stream();
	}
    public function print_customer_convert(){
		$this->Kiemtra();
		
		$order = Customer::all();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			
		}
		$customer = Customer::where('customer_id',$customer_id)->first();

		

		

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h2><center> Cửa hàng đồ gỗ nội thất Kc</center></h2>
		<h3><center>Danh sách khách hàng</center></h3>
	
		
			<table class="table-styling">
				<thead>
					<tr><th></th>
						<th>Tên Người dùng </th>
						<th>Gmail </th>
						<th>Số điện thoại </th>
						<th>Địa chỉ </th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;
               
                $i = 0;
                
				foreach($order as $key => $product){

                    $i++;
		$output.='		
					<tr> 
                        <td>'.$i.'</td>
						<td>'.$product->customer_name.'</td>
                        <td>'.$product->customer_email.'</td>
                        <td>'.$product->customer_phone.'</td>
                        <td>'.$product->customer_dc.'</td>
					</tr>';
				}

			

	
		$output.='				
				</tbody>
			
		</table>

		

		';


		return $output;

	}
}
