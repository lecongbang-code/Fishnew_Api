<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Client controller

Route::put('/put_event_code','ClientController@putEventCode');

Route::put('/put_forgot','ClientController@putForgot');

Route::put('/client_login','ClientController@clientLogin');

Route::get('/get_client_home/{id}','ClientController@getClient_id');

Route::put('/post_client','ClientController@postClient');
Route::put('/put_client/{id}','ClientController@putClient_id');

Route::put('/put_client_pass','ClientController@putClientPass');

Route::get('/get_captcha_elem_key','ClientController@getCaptchaElemKey');

Route::put('/post_admin','ClientController@postClient_id');
// Route::put('/put_admin/{id}','ClientController@putClient_id');

Route::get('/get_question_client_id/{id}','ClientController@getQuestionClientId');

Route::get('/get_comment_client_id/{id}','ClientController@getCommentClientId');

Route::get('/get_reply_question/{id}','ClientController@getReplyQuestionId');
Route::get('/get_reply_comment/{id}','ClientController@getReplyCommentId');

Route::get('/get_reply_question','ClientController@getReplyQuestion');
Route::get('/get_reply_comment','ClientController@getReplyComment');

Route::get('/get_status_reply_comment/{id}','ClientController@getStatusReplyCommentClientId');
Route::get('/get_status_reply_question/{id}','ClientController@getStatusReplyQuestionClientId');



Route::put('/put_status_reply_question_comment/{id}','ClientController@putStatusReplyQuestionComment');

Route::put('/post_view','ClientController@postView');

Route::get('/get_product_banner','ClientController@getProductBanner');
Route::get('/get_product_new_limit','ClientController@getProductNewLimit');
Route::get('/get_product_client_random','ClientController@getProductClientRandom');

Route::get('/get_category_client','ClientController@getCategoryLient');
Route::get('/get_product_client','ClientController@getProductClient');

Route::get('/get_product/{id}','ClientController@getProduct_id');

Route::get('/get_order_client_check/{id}','ClientController@getOrderClientCheck_id');

Route::get('/get_order_client/{id}','ClientController@getOrderClient');

Route::get('/get_order_detail/{id}','ClientController@getOrderDetail');

Route::get('/get_product_amount','ClientController@getProductAmount');

Route::put('/put_cancel_order','ClientController@putCancelOrder');

Route::get('/get_comment_product/{id}','ClientController@getCommentProduct');

Route::get('/get_reply_comment_product/{id}','ClientController@getReplyCommentProduct');

Route::get('/get_question_product/{id}','ClientController@getQuestionProduct');

Route::delete('/delete_question/{id}','ClientController@deleteQuestion');

Route::delete('/delete_comment/{id}','ClientController@deleteComment');

Route::put('/put_check_comment_product','ClientController@putCheckCommentProduct');

Route::get('/get_check_comment_product/{id}','ClientController@getCheckCommentProduct');

Route::get('/get_reply_question_product/{id}','ClientController@getReplyQuestionProduct');

Route::put('/post_question','ClientController@postQuestion');
Route::put('/post_comment','ClientController@postComment');

Route::put('/post_reply_question','ClientController@postReplyQuestion');
Route::put('/post_reply_comment','ClientController@postReplyComment');

Route::get('/get_product_name/{name}','ClientController@getProduct_name');
Route::get('/get_product_category/{id}','ClientController@getProductCategory_id');
Route::get('/get_slider','ClientController@getSlider');
Route::get('/get_footer_client','ClientController@getFooter');

Route::get('/get_order_cart/{id}','ClientController@getOrderCart');

Route::get('/get_cart_item/{id}','ClientController@getCartItem');

Route::put('/put_number_cart_item','ClientController@putNumberCartItem');
Route::delete('/delete_cart_item/{id}','ClientController@deleteCartItem');

Route::get('/get_check_order_cart_header/{id}','ClientController@getCheckOrderCartHeader');

Route::get('/get_event_bonus_code','ClientController@getEventBonusCode');


Route::put('/put_amount_event/{id}','ClientController@putAmountEvent');

Route::put('/put_order_pay','ClientController@putOrderPay');


Route::get('/get_order/{id}','ClientController@getOrder_id');

Route::get('/get_cart_client/{id}','ClientController@getCart_id');

Route::put('/post_order','ClientController@postOrder');

Route::put('/post_order_cart','ClientController@postOrderCart');

Route::put('/put_order_cart','ClientController@putOrderCart');

Route::put('/post_report_client','ClientController@postReportClient');

Route::put('/post_check_order_cart','ClientController@postCheckOrderCart');

Route::get('/get_category_product/{id}','ClientController@getCategoryProduct');

Route::get('/home_get_product_new','ClientController@homeGetProductNew');
Route::get('/home_get_product_random','ClientController@homeGetProductRandom');
Route::get('/home_get_product_by_category/{id}','ClientController@homeGetProductByCategory_id');

Route::get('/home_get_product_hot','ClientController@homeGetProductHot');
Route::get('/home_get_product_price_up','ClientController@homeGetProductPriceUp');
Route::get('/home_get_product_price_down','ClientController@homeGetProductPriceDown');
Route::get('/home_get_product_big_discount','ClientController@homeGetProductBigDiscount');

// Admin controller
    
Route::put('/put_check_comment','AdminController@putCheckComment');
Route::put('/post_check_comment','AdminController@postCheckComment');

// đăng nhập
Route::put('/admin_login','AdminController@adminLogin');

// thông tin khách hàng
Route::get('/get_client','AdminController@getClient');
// Route::get('/get_client/{id}','AdminController@getClient_id');

// thông tin quản trị viên
// Route::get('/get_admin','AdminController@getAdmin');
Route::get('/get_admin/{id}','AdminController@getAdmin_id');
Route::put('/put_admin/{id}','AdminController@putAdmin_id');

// đầu trang
Route::get('/get_comment_new','AdminController@getCommentNew');
Route::get('/get_question_new','AdminController@getQuestionNew');
Route::get('/get_report_new','AdminController@getReportNew');

Route::put('/put_comment_new/{id}','AdminController@putCommentNew');
Route::put('/put_question_new/{id}','AdminController@putQuestionNew');
Route::put('/put_report_new','AdminController@putReportNew');

Route::get('/get_comment','AdminController@getComment');
Route::get('/get_question','AdminController@getQuestion');
Route::get('/get_report','AdminController@getReport');

Route::put('/put_question_status/{id}','AdminController@putQuestionStatus');
Route::put('/put_comment_status/{id}','AdminController@putCommentStatus');


// thông tin quảng cáo
Route::get('/get_banner','AdminController@getBanner');
Route::get('/get_banner/{id}','AdminController@getBanner_id');
Route::put('/put_banner/{id}','AdminController@putBanner_id');

// thông tin khuyến mãi
Route::get('/get_event','AdminController@getEvent');
Route::get('/get_event/{id}','AdminController@getEvent_id');
Route::put('/post_event','AdminController@postEvent');
Route::put('/put_event/{id}','AdminController@putEvent_id');
Route::delete('/delete_event/{id}','AdminController@deleteEvent_id');

// thông tin cá thể
Route::get('/get_sex_add_product','AdminController@getSexAddProduct');
Route::get('/get_sex','AdminController@getSex');
Route::get('/get_sex/{id}','AdminController@getSex_id');
Route::put('/post_sex','AdminController@postSex');
Route::put('/put_sex/{id}','AdminController@putSex_id');
Route::delete('/delete_sex/{id}','AdminController@deleteSex_id');

// thông tin kích thước
Route::get('/get_size_add_product','AdminController@getSizeAddProduct');
Route::get('/get_size','AdminController@getSize');
Route::get('/get_size/{id}','AdminController@getSize_id');
Route::put('/post_size','AdminController@postSize');
Route::put('/put_size/{id}','AdminController@putSize_id');
Route::delete('/delete_size/{id}','AdminController@deleteSize_id');

// thông tin kích thước
Route::get('/get_color_add_product','AdminController@getColorAddProduct');
Route::get('/get_color','AdminController@getColor');
Route::get('/get_color/{id}','AdminController@getColor_id');
Route::put('/post_color','AdminController@postColor');
Route::put('/put_color/{id}','AdminController@putColor_id');
Route::delete('/delete_color/{id}','AdminController@deleteColor_id');

// thông tin thể loại
Route::get('/get_category_add_product','AdminController@getCategoryAddProduct');
Route::get('/get_category','AdminController@getCategory');
Route::get('/get_category/{id}','AdminController@getCategory_id');
Route::put('/post_category','AdminController@postCategory');
Route::put('/put_category/{id}','AdminController@putCategory_id');
Route::delete('/delete_category/{id}','AdminController@deleteCategory_id');

Route::get('/get_category_limit','AdminController@getCategoryLimit');


// thông tin sản phẩm
Route::get('/get_product','AdminController@getProduct');

Route::get('/get_product/{id}','AdminController@getProduct_id');
Route::put('/post_product','AdminController@postProduct');
Route::put('/put_product/{id}','AdminController@putProduct_id');
Route::put('/put_amount_product/{id}','AdminController@putAmountProduct_id');
Route::delete('/delete_product/{id}','AdminController@deleteProduct_id');
Route::delete('/delete_ssc_product/{id}','AdminController@deleteSscProduct_id');

Route::put('/post_sex_product/{id}','AdminController@postSexProduct_id');
Route::put('/post_color_product/{id}','AdminController@postColorProduct_id');
Route::put('/post_size_product/{id}','AdminController@postSizeProduct_id');

Route::get('/get_sex_product','AdminController@getSexProduct');
Route::get('/get_size_product','AdminController@getSizeProduct');
Route::get('/get_color_product','AdminController@getColorProduct');

Route::get('/get_sex_product/{id}','AdminController@getSexProduct_id');
Route::get('/get_size_product/{id}','AdminController@getSizeProduct_id');
Route::get('/get_color_product/{id}','AdminController@getColorProduct_id');

// thông tin đơn hàng
Route::get('/get_order_admin','AdminController@getOrder');
Route::get('/get_order_success','AdminController@getOrderSuccess');
Route::get('/get_order_admin/{id}','AdminController@getOrder_id');
Route::get('/get_cart/{id}','AdminController@getCart_id');
Route::put('/put_order/{id}','AdminController@putOrder_id');
Route::put('/put_status_order/{id}','AdminController@putStatusOder_id');

// thông tin chân trang
Route::get('/get_footer','AdminController@getFooter');
Route::get('/get_footer/{id}','AdminController@getFooter_id');
Route::put('/put_footer/{id}','AdminController@putFooter_id');
Route::put('/put_prepay_order','AdminController@putPrepayOrder');



Route::get('/get_view','AdminController@getView');
Route::get('/get_report_limit','AdminController@getReportLimit');
Route::get('/get_product_limit','AdminController@getProductLimit');
