<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function quen_mk( Request $request)
        {
            $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
            $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
            return view('pages.thanhtoan.quen_mk')->with('category',$cate)->with('material',$mate);
        }
    public function reset_mk( Request $request)
        {
            $data = $request->all();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
            $title_mail = "Lấy lại mật khẩu ".' '.$now;
            $customer = Customer::where('customer_email','=',$data['email_account'])->get();
            foreach($customer as $key => $value){
                $customer_id = $value->customer_id;
            }
            
            if($customer){
                $count_customer = $customer->count();
                if($count_customer==0){
                    return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
                }else{
                       $token_random = Str::random();
                    $customer = Customer::find($customer_id);
                    $customer->customer_token = $token_random;
                    $customer->save();
                    //send mail
                  
                    $to_email = $data['email_account'];//send to this email
                    $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                 
                    $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']); //body of mail.blade.php
                    
                    Mail::send('pages.thanhtoan.forget_pass_notify', ['data'=>$data] , function($message) use ($title_mail,$data){
                        $message->to($data['email'])->subject($title_mail);//send this mail with subject
                        $message->from($data['email'],$title_mail);//send from this mail
                    });
                    //--send mail
                    return redirect()->back()->with('message', 'Gửi mail thành công,vui lòng vào email để reset password');
                }
            }
        }

        public function update_new_pass(Request $request){
            $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
            $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
           
           return view('pages.thanhtoan.new_pass')->with('category',$cate)->with('material',$mate); //1
       }
}
