<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Roles;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function index()
    {
        $this->Kiemtra();
        $admin = Admin::orderBy('admin_id','DESC')->get();
        return view('admin.admin.all_admin')->with(compact('admin'));
    }
    public function indexctm()
    {
        $this->Kiemtra();
        $customer = Customer::orderBy('customer_id','DESC')->get();
        return view('admin.customer.all_customer')->with(compact('customer'));
    }
    public function add_admin(){
        $this->Kiemtra();
        return view('admin.admin.add_admin');
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back();
    }
    public function store_admin(Request $request){
        $data = $request->all();
        $admin_phone = $data['admin_phone'];
        $admin_email = $data['admin_email'];
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_note = 1;
        $admin->admin_password = md5($data['admin_password']);

        $result=DB::table('tbl_admin')->where('admin_phone',$admin_phone)->orWhere('admin_email',$admin_email)->first();
        
  
        if($result){
            $count=$result->admin_phone;
            $count1=$result->admin_email;
            if($count== $admin_phone )
                { 
                    Session::put('message','Số điện thoại '.$admin_phone.'đã có người dùng vui lòng nhập số khác');
                    return Redirect::to('add-admin');
                 }
            elseif($count1== $admin_email )
                { 
                    Session::put('message','Gmail '.$admin_email.' đã có người dùng vui lòng nhập gmail khác');
                    return Redirect::to('add-admin');
                 }
            else{
                  
                    Session::put('message','Thêm users thất bại');
                    return Redirect::to('add-admin');
                }
           }
        else{
             
            $admin->save();
            $admin->roles()->attach(Roles::where('name','user')->first());     
            Session::put('message','Thêm users thành công');
            return Redirect::to('add-admin');
        }
      
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset_admin1()
    { 
        return view('admin.admin.reset-admin');
    }
    public function reset_admin(Request $request)
        {
       
        $data = $request->validate([
            'admin_email' => 'required',
            'admin_phone' => 'required',
            'admin_ns' => 'required',
            'g-recaptcha-response' => new Captcha(), 
        ]);
        $admin_email = $data['admin_email'];
        $admin_phone = $data['admin_phone'];
        $admin_ns = $data['admin_ns'];
       $result = Admin::where('admin_email',$admin_email)->where('admin_phone',$admin_phone)->where('admin_ns',$admin_ns)->where('admin_ns',$admin_ns)->first();
       if($result){
        $reset_count=$result->count();
        if($reset_count>0)
            { 
                $token_random = Str::random();
                
                DB::table('tbl_admin')->where('admin_id',$result->admin_id)->update(['admin_password'=>md5($token_random)]);
                Session::put('message','Đây là mật khẩu mới của bạn vui lòng đăng nhập và thay đổi mk : '. $token_random.'');
                return Redirect::to('/reset-admin1');
                }
       }
        else{
            Session::put('message', 'Thông tin bạn nhập không trùng khớp');
            return Redirect::to('/reset-admin1');
        }
    }
    
    public function reset_customer(Request $request)
        {
       
        $data = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
        ]);
        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];
        $customer_phone = $data['customer_phone'];
       $result = Customer::where('customer_name',$customer_name)->where('customer_email',$customer_email)->where('customer_phone',$customer_phone)->first();
       if($result){
        $reset_count=$result->count();
        if($reset_count>0)
            { 
                $token_random = Str::random();
                
                DB::table('tbl_customers')->where('customer_id',$result->customer_id)->update(['customer_password'=>md5($token_random)]);
                Session::put('message','Đây là mật khẩu mới của bạn vui lòng đăng nhập và thay đổi mk : '. $token_random.'');
                return Redirect::to('/dn_thanhtoan');
                }
       }
        else{
            Session::put('message', 'Thông tin bạn nhập không trùng khớp');
            return Redirect::to('/quen-mk');
        }
    }
    public function update_customer(Request $request, $id){
       
        $data = array();
        $data ['customer_name'] = $request->customer_name;
        $data ['customer_ns'] = $request->customer_ns;
        $data ['customer_gt'] = $request->customer_gt;
        $data ['customer_phone'] = $request->customer_phone;
        $data ['customer_email'] = $request->customer_email;
        $data ['customer_dc'] = $request->customer_dc;
       
        $get_image =$request-> file('customer_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/customers',$new_image);
            $data['customer_image']=$new_image;
            DB::table('tbl_customers')->where('customer_id',$id)->update($data);
            Session::put('message','Chỉnh sửa thành công');
            return Redirect::to('view-customer');
        }
     
        DB::table('tbl_customers')->where('customer_id',$id)->update($data);
            Session::put('message','Chỉnh sửa thành công');
            return Redirect::to('view-customer');
    }
    public function editpass_customer()
    {
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        $customer_id = Session::get('customer_id');
        $view = DB::table('tbl_customers')->where('customer_id',$customer_id)->get();
       
        return view('pages.customer.edit_customer')->with('category',$cate)->with('material',$mate)->with('view_customer',$view); 
    }
    public function editpass1_customer(Request $request, $id)
    {
       
        $data = $request->validate([
            'customer_password1' => 'required',
            'customer_password2' => 'required',
            'customer_password3' => 'required',
        ]);
        $customer_password = md5($data['customer_password1']);
        $customer_password2 = md5($data['customer_password2']);
        $customer_password3 = md5($data['customer_password3']);
        $result = DB::table('tbl_customers')->where('customer_id',$id)->where('customer_password',$customer_password)->get();
        if($result){
            $login_count=$result->count();
            if($login_count>0)
                {
                    if($customer_password2==$customer_password3){
                        DB::table('tbl_customers')->where('customer_id',$id)->update(['customer_password'=>$customer_password2]);
                        Session::put('message','Update thành công');
                        return Redirect::to('editpass-customer');
                    }
                    else{
                        Session::put('message','lỗi mật khẩu mới không trùng');
                        return Redirect::to('editpass-customer');
                            }   
                    }
             else{
                Session::put('message','lỗi mật khẩu cũ không đúng');
                return Redirect::to('editpass-customer');
                    }         
                }
       
      
    }


}
