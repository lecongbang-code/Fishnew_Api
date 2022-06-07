<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;

class AdminController extends Controller
{

    public function adminLogin(Request $request)
    {
        $data = array();
        
        $data['username'] = $request->username;
        $data['password'] = $request->password;

        $result = DB::table('admins')->where('username',$data['username'])->where('password',$data['password'])->first();

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getComment()
    {
        $result = DB::table('comments')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getQuestion()
    {
        $result = DB::table('questions')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReport()
    {
        $result = DB::table('reports')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCommentNew()
    {
        $result = DB::table('comments')->orderby('id','desc')->where('reply_status', 0)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getQuestionNew()
    {
        $result = DB::table('questions')->orderby('id','desc')->where('reply_status', 0)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReportNew()
    {
        $result = DB::table('reports')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putCommentNew($id)
    {
        $data = array();
        $data['reply_status'] = 1;

        $result = DB::table('comments')->where('id', $id)->update($data);

        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putQuestionNew($id)
    {
        $data = array();
        $data['reply_status'] = 1;
        $result = DB::table('questions')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putQuestionStatus(Request $request, $id)
    {
        $data = array();
        $data['status'] = $request->status;
        $result = DB::table('questions')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putCommentStatus(Request $request, $id)
    {
        $data = array();
        $data['status'] = $request->status;
        $result = DB::table('comments')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putReportNew()
    {
        $data = array();
        $data['status'] = 0;
        $result = DB::table('reports')->where('status', '1')->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getClient()
    {
        $result = DB::table('clients')
        ->select('id','avatar','name','phone')
        ->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getClient_id($id)
    {
        $result = DB::table('clients')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    // public function getAdmin()
    // {
    //     $result = DB::table('admins')->orderby('id','desc')->get();
    //     $responsecode = 200;
    //     $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
    //     return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    // }

    public function getAdmin_id($id)
    {
        $result = DB::table('admins')
        ->select('id','username','avatar','name','sex','phone','email','address','status')
        ->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putAdmin_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['avatar'] = $request->avatar;
        $data['sex'] = $request->sex;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;

    	$result = DB::table('admins')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_banner()
    {
        $result = DB::table('products')->where('banner_status', true)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }


    public function getBanner_id($id)
    {
        $result = DB::table('products')->where('id', $id)->where('banner_status', true)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putBanner(Request $request, $id)
    {
        $data = array();
    	$data['banner_status'] = $request->banner_status;

    	$result = DB::table('products')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getEvent()
    {
        $result = DB::table('events')->orderby('id','desc')->get();
        // $responsecode = 200;
        // $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        // return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
        return $result;
    }

    public function getEvent_id($id)
    {
        $result = DB::table('events')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postEvent(Request $request)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['bonus_code'] = $request->bonus_code;
        $data['bonuses'] = $request->bonuses;
        $data['amount'] = $request->amount;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

    	$result = DB::table('events')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putEvent_id(Request $request, $id)
    {
        $data = array();
    	$data['title'] = $request->title;
        $data['bonus_code'] = $request->bonus_code;
        $data['bonuses'] = $request->bonuses;
        $data['amount'] = $request->amount;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

    	$result = DB::table('events')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteEvent_id($id)
    {
        $result = DB::table('events')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

/////////
    public function getSexAddProduct()
    {
        $result = DB::table('sexes')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSex()
    {
        $result = DB::table('sexes')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSex_id($id)
    {
        $result = DB::table('sexes')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postSex(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('sexes')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putSex_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('sexes')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteSex_id($id)
    {
        $result = DB::table('sexes')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
    ///////

    public function getSizeAddProduct()
    {
        $result = DB::table('sizes')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSize()
    {
        $result = DB::table('sizes')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSize_id($id)
    {
        $result = DB::table('sizes')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postSize(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('sizes')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putSize_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('sizes')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteSize_id($id)
    {
        $result = DB::table('sizes')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    //////////

    public function getColor()
    {
        $result = DB::table('colors')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getColorAddProduct()
    {
        $result = DB::table('colors')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getColor_id($id)
    {
        $result = DB::table('colors')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postColor(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['color_code'] = $request->color_code;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('colors')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putColor_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['color_code'] = $request->color_code;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('colors')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteColor_id($id)
    {
        $result = DB::table('colors')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    ////////////

    public function getCategoryLimit()
    {
        $result = DB::table('categories')->orderby('id','desc')->where('status', 1)->limit(4)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }


    public function getCategoryAddProduct()
    {
        $result = DB::table('categories')->orderby('id','desc')->where('status', 1)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCategory()
    {
        $result = DB::table('categories')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }


    public function getCategory_id($id)
    {
        $result = DB::table('categories')->where('id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postCategory(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['image_path'] = $request->image_path;
        $data['created_at'] = $request->created_at;
        $data['status'] = $request->status;

    	$result = DB::table('categories')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putCategory_id(Request $request, $id)
    {
        $data = array();
    	$data['name'] = $request->name;
        $data['image_path'] = $request->image_path;
        $data['status'] = $request->status;

    	$result = DB::table('categories')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    
    public function putPrepayOrder(Request $request)
    {
        $data = array();
        $id = $request->id;
        $data['order_prepay'] = $request->order_prepay;
        $data['order_total_price_old'] = $request->order_total_price_old;

        $result = DB::table('orders')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteCategory_id($id)
    {
        $result = DB::table('categories')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSexProduct()
    {
        $result = DB::table('sex_products')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSizeProduct()
    {
        $result = DB::table('size_products')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getColorProduct()
    {
        $result = DB::table('color_products')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProduct()
    {
        $result = DB::table('products')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProduct_id($id)
    {
        $result = DB::table('products')->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postProduct(Request $request)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['image_path_1'] = $request->image_path_1;
        $data['image_path_2'] = $request->image_path_2;
        $data['image_path_3'] = $request->image_path_3;
        $data['image_path_4'] = $request->image_path_4;
        $data['video_path'] = $request->video_path;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['discount'] = $request->discount;
        $data['old_price'] = $request->old_price;
        $data['new_price'] = $request->new_price;
        $data['sex'] = 0;
        $data['size'] = 0;
        $data['color'] = 0;
        $data['amount'] = $request->amount;
        $data['amount_total'] = $request->amount_total;
        $data['ratings'] = 0;
        $data['question_status'] = $request->question_status;
        $data['comment_status'] = $request->comment_status;
        $data['all_sizes_status'] = $request->all_sizes_status;
        $data['banner_status'] = $request->banner_status;
        $data['created_at'] = $request->created_at;
        $data['status'] = $request->status;

        $result = DB::table('products')->insert($data);
        if($result)
        {
            $result = DB::table('products')->orderby('id','desc')->first();
        }
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putProduct_id(Request $request, $id)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['image_path_1'] = $request->image_path_1;
        $data['image_path_2'] = $request->image_path_2;
        $data['image_path_3'] = $request->image_path_3;
        $data['image_path_4'] = $request->image_path_4;
        $data['video_path'] = $request->video_path;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['discount'] = $request->discount;
        $data['old_price'] = $request->old_price;
        $data['new_price'] = $request->new_price;
        $data['sex'] = 0;
        $data['size'] = 0;
        $data['color'] = 0;
        $data['amount'] = $request->amount;
        $data['ratings'] = 0;
        $data['question_status'] = $request->question_status;
        $data['comment_status'] = $request->comment_status;
        $data['all_sizes_status'] = $request->all_sizes_status;
        $data['banner_status'] = $request->banner_status;
        $data['created_at'] = $request->created_at;
        $data['status'] = $request->status;

    	$result = DB::table('products')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putAmountProduct_id(Request $request, $id)
    {
        $data = array();
        $data['amount'] = $request->amount;
        $result = DB::table('products')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function deleteProduct_id($id)
    {
        $result = DB::table('products')->where('id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }


    public function deleteSscProduct_id($id)
    {
        DB::table('sex_products')->where('product_id',$id)->delete();
        DB::table('size_products')->where('product_id',$id)->delete();
        $result = DB::table('color_products')->where('product_id',$id)->delete();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postSexProduct_id(Request $request, $id)
    {
        $data = array();
        $data['product_id'] = $id;
        $data['name'] = $request->name;
        $data['status'] = 1;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $result = DB::table('sex_products')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postSizeProduct_id(Request $request, $id)
    {
        $data = array();
        $data['product_id'] = $id;
        $data['name'] = $request->name;
        $data['status'] = 1;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $result = DB::table('size_products')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postColorProduct_id(Request $request, $id)
    {
        $data = array();
        $data['product_id'] = $id;
        $data['name'] = $request->name;
        $data['color_code'] = "#";
        $data['status'] = 1;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $result = DB::table('color_products')->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrder()
    {
        $result = DB::table('orders')->orderby('id','desc')->where('status','<>','Đang tạo')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getOrderSuccess()
    {
        $result = DB::table('orders')->orderby('id','desc')->where('status','Đã nhận')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    

    public function getOrder_id($id)
    {
        $result = DB::table('orders')->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getCart_id($id)
    {
        $result = DB::table('order_carts')->where('order_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putOrder_id(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['payments'] = $request->payments;
        $data['transport_fee'] = $request->transport_fee;
        $data['total_price'] = $request->total_price;
        $data['status_payment'] = $request->status_payment;
        $data['client_id'] = $request->client_id;
        $data['client_name'] = $request->client_name;
        $data['client_phone'] = $request->client_phone;
        $data['client_address'] = $request->client_address;
        $data['status'] = $request->status;

    	$result = DB::table('orders')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putCheckComment(Request $request)
    {
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['client_id'] = $request->client_id;
        $data['status'] = '1';

        $result = DB::table('check_comments')
        ->where('product_id', $data['product_id'])
        ->where('client_id', $data['client_id'])
        ->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function postCheckComment(Request $request)
    {
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['client_id'] = $request->client_id;
        $data['status'] = '1';

        $result = DB::table('check_comments')
        ->insert($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putStatusOder_id(Request $request, $id)
    {
        $data = array();
        $data['status'] = $request->status;

        if($request->updated_at)
        {
            $data['updated_at'] = $request->updated_at;
        }
        if($request->received_date)
        {
           $data['received_date'] = $request->received_date; 
        }

    	$result = DB::table('orders')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getFooter()
    {
        $result = DB::table('footer')->orderby('id','desc')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getFooter_id($id)
    {
        $result = DB::table('footers')->where('id', $id)->first();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function putFooter_id(Request $request, $id)
    {
        $data = array();
        $data['name_shop'] = $request->name_shop;
        $data['logo'] = $request->logo;
        $data['description'] = $request->description;

        if($request->name_ecommerce_1)
            $data['name_ecommerce_1'] = $request->name_ecommerce_1;
        else
            $data['name_ecommerce_1'] = '';

        if($request->url_ecommerce_1)
            $data['url_ecommerce_1'] = $request->url_ecommerce_1;
        else
            $data['url_ecommerce_1'] = '';


        if($request->name_ecommerce_2)
            $data['name_ecommerce_2'] = $request->name_ecommerce_2;
        else
            $data['name_ecommerce_2'] = '';

        if($request->url_ecommerce_2)
            $data['url_ecommerce_2'] = $request->url_ecommerce_2;
        else
            $data['url_ecommerce_2'] = '';

        if($request->name_ecommerce_3)
            $data['name_ecommerce_3'] = $request->name_ecommerce_3;
        else
            $data['name_ecommerce_3'] = '';

        if($request->url_ecommerce_3)
            $data['url_ecommerce_3'] = $request->url_ecommerce_3;
        else
            $data['url_ecommerce_3'] = '';

        $data['phone_1'] = $request->phone_1;
        $data['phone_2'] = $request->phone_2;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['created_at'] = $request->created_at;
        $data['updated_at'] = $request->updated_at;
        $data['status'] = $request->status;

        $result = DB::table('footers')->where('id', $id)->update($data);
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSexProduct_id($id)
    {
        $result = DB::table('sex_products')->where('product_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getSizeProduct_id($id)
    {
        $result = DB::table('size_products')->where('product_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getColorProduct_id($id)
    {
        $result = DB::table('color_products')->where('product_id', $id)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getView()
    {
        $result = DB::table('views')->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getReportLimit()
    {
        $result = DB::table('reports')->orderby('id','desc')->limit(3)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function getProductLimit()
    {
        $result = DB::table('products')->orderby('id','desc')->limit(3)->get();
        $responsecode = 200;
        $header = array ('Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8');
        return response()->json($result, $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }
}
