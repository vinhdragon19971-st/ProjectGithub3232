<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//*************************************** */
//**********Controller*For*Admin**********
//*************************************** */
// User-Role-Admin

Route::get('/admin','AdminController@index');

Route::get('/login-admin','AdminController@login_admin');

Route::POST('/admin-checkout','AdminController@admin_checkout');

Route::get('/logout-admin','AdminController@logout_admin');

// User
Route::get('/admin/view-create-user','UserController@view_create_user');

Route::POST('/admin/create-user','UserController@create_user');

Route::get('/admin/view-list-user-student','UserController@view_list_user_student');

Route::get('/admin/view-list-user-coordinator','UserController@view_list_user_coordinator');

Route::get('/admin/view-list-user-manager','UserController@view_list_user_manager');

Route::get('/admin/view-list-user-guest','UserController@view_list_user_guest');

Route::get('/admin/view-list-user-admin','UserController@view_list_user_admin');

Route::get('/admin/edit-user/{user_id}{user_role}','UserController@edit_user');

Route::get('/admin/delete-user/{user_id}','UserController@delete_user');

Route::POST('/admin/update-user/{user_id}','UserController@update_user');

// Course
Route::get('/admin/view-create-course','CourseController@view_create_course');

Route::get('/admin/view-list-course','CourseController@view_list_course');

Route::POST('/admin/create-course','CourseController@create_course');

Route::get('/admin/edit-course/{course_id}','CourseController@edit_course');

Route::POST('/admin/update-course/{course_id}','CourseController@update_course');

Route::get('/admin/delete-course/{course_id}','CourseController@delete_course');

// Category
Route::get('/admin/view-create-category','CategoryController@view_create_category');

Route::get('/admin/view-list-category','CategoryController@view_list_category');

Route::POST('/admin/create-category','CategoryController@create_category');

Route::get('/admin/edit-category/{category}','CategoryController@edit_category');

Route::POST('/admin/update-category/{category}','CategoryController@update_category');

Route::get('/admin/delete-category/{category}','CategoryController@delete_category');

// Assignment
Route::get('/admin/view-create-assignment','AssignmentController@view_create_assignment');

Route::get('/admin/view-list-assignment','AssignmentController@view_list_assignment');

Route::POST('/admin/create-assignment','AssignmentController@create_assignment');

Route::get('/admin/edit-assignment/{asm_id}','AssignmentController@edit_assignment');

Route::POST('/admin/update-assignment/{asm_id}','AssignmentController@update_assignment');

Route::get('/admin/delete-assignment/{asm_id}','AssignmentController@delete_assignment');

//*************************************** */
//**********Controller*For*User**********
//*************************************** */
//Home
Route::get('/','HomeController@index');

//User
Route::POST('/login-user','UserController@login_user');

Route::get('/logout-user','UserController@logout_user');

//Course
Route::get('/course-of-category','CourseController@Course_of_Category');

Route::get('/course-of-category/{category_id}','CourseController@Show_Course_of_Category');

//Assignment

Route::get('/assignment/{course_id}','AssignmentController@View_Assignment');

//Mark

Route::get('/mark/{course_id}','MarkController@View_Mark');

//Submission

Route::POST('/assignment/submission/{course_id}','SubmissionController@Submission');
