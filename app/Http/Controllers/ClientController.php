<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Mail;

class ClientController extends Controller
{
    public function putForgot(Request $request)
    {
        $title = "Mật khẩu & Tài khoản của bạn";
        
        $to_email = $request->email;
        $username = $request->username;

        $result = DB::table('clients')->where('facebook_id', $username)->first();

        if($result)
        {
            $name = $username;
            $password = $result->password;
            Mail::send('emails.form_forgot_password', compact('username','password'), function($email) use($name, $to_email, $title) {
                $email->subject($title);
                $email->to($to_email, $name);
            });
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function putEventCode(Request $request)
    {
        $title = "Mã Giảm giá dành cho bạn";

        $to_email = $request->email;
        $name = $request->name;

        Mail::send('emails.form_event_code', compact('name'), function($email) use($name, $to_email, $title) {
            $email->subject($title);
            $email->to($to_email, $name);
        });
    }

    public function clientLogin(Request $request)
    {
        $facebook_id = $request->username;
        $password = $request->password;
        
        $result = DB::table('clients')->where('facebook_id',$facebook_id)->where('password',$password)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getClient_id($id)
    {
        $result = DB::table('clients')
        ->select('id','facebook_id','avatar','name','sex','phone','email','address','status')
        ->where('facebook_id', $id)
        ->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCaptchaElemKey()
    {
        $result = DB::table('footers')->select('captchaElemKey')->first();
        return $result;
    }

    public function getProductBanner()
    {
        $result = DB::table('products')
        ->where('banner_status', 1)
        ->where('amount', '>', 0)
        ->where('status', 1)
        ->orderby('id','desc')->limit(3)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderCart($id)
    {
        $result = DB::table('orders')->where('client_id', $id)->where('status', 'Đang tạo')->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getQuestionClientId($id)
    {
        $result = DB::table('questions')->where('client_id', $id)->where('status', '1')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCommentClientId($id)
    {
        $result = DB::table('comments')->where('client_id', $id)->where('status', '1')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyQuestionId($id)
    {
        $result = DB::table('reply_questions')->where('question_client_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyQuestion()
    {
        $result = DB::table('reply_questions')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getStatusReplyCommentClientId($id)
    {
        $result = DB::table('reply_comments')
        ->where('comment_client_id', $id)
        ->where('reply_status', 0)
        ->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getStatusReplyQuestionClientId($id)
    {
        $result = DB::table('reply_questions')
        ->where('question_client_id', $id)
        ->where('reply_status', 0)
        ->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyCommentId($id)
    {
        $result = DB::table('reply_comments')->where('comment_client_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyComment()
    {
        $result = DB::table('reply_comments')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCartItem($id)
    {
        $result = DB::table('order_carts')->where('order_id', $id)->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putStatusReplyQuestionComment($id)
    {
        $data = array();
        $data['reply_status'] = 1;
  
        $result = DB::table('reply_questions')->where('question_client_id', $id)->update($data);
        
        $result = DB::table('reply_comments')->where('comment_client_id', $id)->update($data);

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    
    public function putCancelOrder(Request $request)
    {
        $data = array();
        $id = $request->id;
        $data['client_note'] = $request->client_note;
        $data['status'] = "Đã hủy";
  
        $result = DB::table('orders')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postQuestion(Request $request)
    {
        $data = array();
        $data['client_id'] = $request->client_id;
        $data['client_name'] = $request->client_name;
        $data['avatar'] = $request->avatar;
        $data['product_id'] = $request->product_id;
        $data['product_img'] = $request->product_img;
        $data['product_name'] = $request->product_name;
        $data['content'] = $request->content;
        $data['reply_status'] = $request->reply_status;
        $data['status'] = $request->status;
        $data['created_at'] = $request->created_at;
  
        $result = DB::table('questions')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postComment(Request $request)
    {
        $data = array();
        $data['client_id'] = $request->client_id;
        $data['client_name'] = $request->client_name;
        $data['avatar'] = $request->avatar;
        $data['product_id'] = $request->product_id;
        $data['product_img'] = $request->product_img;
        $data['product_name'] = $request->product_name;
        $data['content'] = $request->content;
        $data['rating'] = $request->rating;
        $data['reply_status'] = $request->reply_status;
        $data['status'] = $request->status;
        $data['created_at'] = $request->created_at;
  
        $result = DB::table('comments')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postReplyQuestion(Request $request)
    {
        $data = array();
        $data['client_id'] = $request->client_id;
        $data['question_id'] = $request->question_id;
        $data['question_client_id'] = $request->question_client_id;
        $data['product_id'] = $request->product_id;
        $data['client_name'] = $request->client_name;
        $data['avatar'] = $request->avatar;
        $data['content'] = $request->content;
        $data['reply_status'] = $request->reply_status;
        $data['status'] = $request->status;
        $data['created_at'] = $request->created_at;
  
        $result = DB::table('reply_questions')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postReplyComment(Request $request)
    {
        $data = array();
        $data['client_id'] = $request->client_id;
        $data['comment_id'] = $request->comment_id;
        $data['comment_client_id'] = $request->comment_client_id;
        $data['product_id'] = $request->product_id;
        $data['client_name'] = $request->client_name;
        $data['avatar'] = $request->avatar;
        $data['content'] = $request->content;
        $data['reply_status'] = $request->reply_status;
        $data['status'] = $request->status;
        $data['created_at'] = $request->created_at;
  
        $result = DB::table('reply_comments')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    
    public function postView(Request $request)
    {
        $data = array();
        $data['view'] = '1';
  
        $result = DB::table('views')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductNewLimit()
    {
        $result = DB::table('products')->where('banner_status', 1)->where('status', 1)->where('amount', '>', 0)->inRandomOrder()->limit(6)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductClientRandom()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->inRandomOrder()->limit(12)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    /////////////

    public function homeGetProductHot()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->orderby('amount','asc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    public function homeGetProductPriceUp()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->orderby('new_price','asc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    public function homeGetProductPriceDown()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->orderby('new_price','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    public function homeGetProductBigDiscount()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->orderby('discount','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function homeGetProductNew()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function homeGetProductRandom()
    {
        $result = DB::table('products')->where('status', 1)->where('amount', '>', 0)->inRandomOrder()->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function homeGetProductByCategory_id($id)
    {
        $result = DB::table('products')->where('category_id', $id)->where('amount', '>', 0)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCheckOrderCartHeader($id)
    {
        $result = DB::table('order_carts')->where('order_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCommentProduct($id)
    {
        $result = DB::table('comments')->where('product_id', $id)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyCommentProduct($id)
    {
        $result = DB::table('reply_comments')->where('product_id', $id)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteQuestion($id)
    {
        $result = DB::table('questions')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteComment($id)
    {
        $result = DB::table('comments')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getQuestionProduct($id)
    {
        $result = DB::table('questions')->where('product_id', $id)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReplyQuestionProduct($id)
    {
        $result = DB::table('reply_questions')->where('product_id', $id)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    
    ////////////////

    public function getCategoryLient()
    {
        $result = DB::table('categories')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductClient()
    {
        $result = DB::table('products')->where('amount', '>', 0)->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCategoryProduct($id)
    {
        $result = DB::table('categories')->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderClientCheck_id($id)
    {
        $result = DB::table('orders')->where('client_id', $id)->where('status', 'Đang tạo')->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProduct_id($id)
    {
        $result = DB::table('products')->where('status', 1)->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProduct_name($name)
    {
        $result = DB::table('products')->where('amount', '>', 0)->where('product_name', $name)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductCategory_id($id)
    {
        $result = DB::table('products')->where('amount', '>', 0)->where('status', 1)->where('category_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSlider()
    {
        $result = DB::table('products')->where('amount', '>', 0)->where('status', 1)->inRandomOrder()->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getFooter()
    {
        $result = DB::table('footers')->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    
    public function getCheckCommentProduct($id)
    {
        $result = DB::table('check_comments')->where('product_id', $id)->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrder_id($id)
    {
        $result = DB::table('orders')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductAmount()
    {
        $result = DB::table('products')->select('id', 'amount')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderClient($id)
    {
        $result = DB::table('orders')
        ->where('client_id', $id)
        ->where('status','<>','Đang tạo')
        ->orderby('id','desc')
        ->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderDetail($id)
    {
        $result = DB::table('orders')->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderCart_id($id)
    {
        $result = DB::table('order_carts')->where('order_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }


    public function postReportClient(Request $request)
    {
        $data = array();
        
        $data['client_id'] = $request->client_id;
        $data['client_name'] = $request->client_name;
        $data['content'] = $request->content;
        $data['created_at'] = $request->created_at;
        $data['status'] = 1;
  
        $result = DB::table('reports')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postClient(Request $request)
    {
        $data = array();
        
        $data['name'] = $request->name;
        $data['facebook_id'] = $request->username;
        $data['password'] = $request->password;
        $data['avatar'] = $request->avatar;
        $data['sex'] = 1;
        $data['phone'] = '';
        $data['email'] = '';
        $data['address'] = '';
        $data['status'] = 0;
  
        $result = DB::table('clients')->insert($data);
        if($result)
        {
            $result = DB::table('clients')->where('facebook_id', $data['facebook_id'])->first();
        }
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putClient_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
  
        $result = DB::table('clients')->where('facebook_id', $id)->update($data);
        if($result)
        {
            $result = DB::table('clients')
            ->select('id','facebook_id','avatar','name','sex','phone','email','address','status')
            ->where('facebook_id', $id)
            ->first();
        }
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putClientPass(Request $request)
    {
        $data = array();
        $data['password'] = $request->new_password;

        $facebook_id = $request->id;
        $password = $request->password;
  
        $result = DB::table('clients')
        ->where('facebook_id', $facebook_id)
        ->where('password', $password)
        ->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    
    public function putCheckCommentProduct(Request $request)
    {
        $data = array();
        $data['client_id'] = $request->client_id;
        $data['product_id'] = $request->product_id;
        $data['status'] = '0';
  
        $result = DB::table('check_comments')
        ->where('client_id', $data['client_id'])
        ->where('product_id', $data['product_id'])
        ->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postOrderCart(Request $request)
    {
        $data = array();

        $data['order_id'] = $request->order_id;
        $data['product_id'] = $request->product_id;
        $data['product_name'] = $request->product_name;
        $data['product_image_path'] = $request->product_image_path;
        $data['product_sex'] = $request->product_sex;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_number'] = $request->product_number;
        $data['product_old_price'] = $request->product_old_price;
        $data['product_dis_price'] = $request->product_dis_price;
        $data['product_new_price'] = $request->product_new_price;
        $data['status'] = 1;
  
        $result = DB::table('order_carts')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putOrderCart(Request $request)
    {
        $data = array();

        $data['id'] = $request->id;
        $data['order_id'] = $request->order_id;
        $data['product_id'] = $request->product_id;

        $data['product_number'] = $request->product_number + $request->product_old_number;
  
        $result = DB::table('order_carts')
        ->where('id', $data['id'])
        ->where('order_id', $data['order_id'])
        ->where('product_id', $data['product_id'])
        ->update($data);

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postCheckOrderCart(Request $request)
    {
        $data = array();

        $data['order_id'] = $request->order_id;
        $data['product_id'] = $request->product_id;
        $data['product_sex'] = $request->product_sex;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;

    	$result = DB::table('order_carts')
        ->where('order_id', $data['order_id'])
        ->where('product_id', $data['product_id'])
        ->where('product_sex', $data['product_sex'])
        ->where('product_size', $data['product_size'])
        ->where('product_color', $data['product_color'])
        ->first();

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postOrder(Request $request)
    {
        $data = array();

        $data['order_name'] = '';
        $data['order_payments'] = '';
        $data['order_transport_fee'] = '';
        $data['order_total_price'] = '';
        $data['order_total_price_old'] = '';
        $data['order_prepay'] = '';
        $data['bonus_code'] = '';
        $data['bonuses'] = '';
        $data['client_id'] = $request->client_id;
        $data['client_name'] = '';
        $data['client_phone'] = '';
        $data['client_address'] = '';
        $data['client_note'] = '';
        $data['status'] = $request->status;

    	$result = DB::table('orders')->insert($data);

        if($result)
        {
            $result = DB::table('orders')
            ->orderby('id','desc')
            ->where('client_id', $data['client_id'])
            ->where('status', 'Đang tạo')
            ->first();
        }

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putNumberCartItem(Request $request)
    {
        $data = array();

        $data['id'] = $request->id;
        $data['product_number'] = $request->product_number;
  
        $result = DB::table('order_carts')->where('id', $data['id'])->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putAmountEvent(Request $request, $id)
    {
        $data = array();

        $data['amount'] = $request->amount;
  
        $result = DB::table('events')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteCartItem($id)
    {
        $result = DB::table('order_carts')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getEventBonusCode()
    {
        $result = DB::table('events')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    
    public function putOrderPay(Request $request)
    {
        $data = array();

        $id = $request->id;

        $data['order_name'] = $request->order_name;
        $data['order_payments'] = $request->order_payments;
        $data['order_transport_fee'] = $request->order_transport_fee;
        $data['order_total_price_old'] = $request->order_total_price_old;
        $data['order_total_price'] = $request->order_total_price;
        $data['order_prepay'] = $request->order_prepay;
        $data['bonuses'] = $request->bonuses;
        $data['bonus_code'] = $request->bonus_code;
        $data['client_name'] = $request->client_name;
        $data['client_phone'] = $request->client_phone;
        $data['client_address'] = $request->client_address;
        if($request->client_note !='')
            $data['client_note'] = $request->client_note;
        $data['created_at'] = $request->created_at;
        $data['status'] = $request->status;
  
        $result = DB::table('orders')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
}
