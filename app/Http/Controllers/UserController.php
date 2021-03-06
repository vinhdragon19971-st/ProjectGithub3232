<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class UserController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //*************************************** */
    //**********Controller*For*Admin**********
    //*************************************** */
    public function AuthLogin(){
        $user_id = Session::get('user_id');
        if($user_id){
            $role_id = Session::get('user_role');
            if($role_id == 0){
                return Redirect::to('/admin');
            }else{
                return Redirect::to('/login-admin')->send();
        }
        }else{
            return Redirect::to('/login-admin')->send();
        }        
    }

    public function view_create_user(){
        $this->AuthLogin();

        return view('admin.create_user');
    }

    public function create_user(Request $request)
    {
        $this->AuthLogin();
        //insert product
        //['namedatebase] = name"html"
        $data = array();
        $data['user_email'] = $request->user_email;
        $data['user_password'] = md5($request->user_password);
        $data['user_fullname'] = $request->user_fullname;
        $data['user_phone'] = $request->user_phone;
        $data['user_gender'] = $request->user_gender;
        $data['user_birthday'] = $request->user_birthday;
        $data['user_role'] = $request->user_role;
        $data['user_image'] = $request->user_image;
        $get_image = $request->file('user_image');

        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not ".jpg" - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $new_image = $name_image.mt_rand().date_default_timezone_get()
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/avatar', $new_image);
            //closing down
            $data['user_image'] = $new_image;

            DB::Table('tbl_user')->insert($data);
            Session::put('message','Create User Success !!!');
            return Redirect::to('/admin/view-create-user');
        }
        else{
            $data['user_image'] = '';

            DB::Table('tbl_user')->insert($data);
            Session::put('message','Create User Success but no Image !!!');
            return Redirect::to('/admin/view-create-user');
        }
    }

    public function view_list_user_admin()
    {
        $this->AuthLogin();
        //Show all list
        $all_admin = DB::Table('tbl_user')->where('user_role','0')->orderby('user_id','desc')->get();
        
        return view('admin.list_user_admin')->with('all_admin',$all_admin);
    }

    public function view_list_user_student()
    {
        $this->AuthLogin();
        //Show all list
        $all_student = DB::Table('tbl_user')->where('user_role','1')->orderby('user_id','desc')->get();
        
        return view('admin.list_user_student')->with('all_student',$all_student);
    }

    public function view_list_user_coordinator()
    {
        $this->AuthLogin();
        //Show all list
        $all_coordinator = DB::Table('tbl_user')->where('user_role','2')->orderby('user_id','desc')->get();
        
        return view('admin.list_user_coordinator')->with('all_coordinator',$all_coordinator);
    }
    
    public function view_list_user_manager()
    {
        $this->AuthLogin();
        //Show all list
        $all_cmanager = DB::Table('tbl_user')->where('user_role','3')->orderby('user_id','desc')->get();
        
        return view('admin.list_user_manager')->with('all_manager',$all_cmanager);
    }

    public function view_list_user_guest()
    {
        $this->AuthLogin();
        //Show all list
        $all_guest = DB::Table('tbl_user')->where('user_role','4')->orderby('user_id','desc')->get();

        
        return view('admin.list_user_guest')->with('all_guest',$all_guest);
    }   

    public function edit_user($user_id, $user_role)
    {
        $this->AuthLogin();
        $edit_user = DB::Table('tbl_user')->where('user_id', $user_id)->get();
        Session::put('user_role', $user_role);

        return view('admin.edit_user')->with('edit_user',$edit_user);
    }

    public function update_user(Request $request, $user_id)
    {
        $this->AuthLogin();
        //insert product
        $data = array();
        $data['user_fullname'] = $request->user_fullname;
        $data['user_phone'] = $request->user_phone;        
        $data['user_birthday'] = $request->user_birthday;
        $data['user_gender'] = $request->user_gender;
        $data['user_role'] = $request->user_role;
        $data['user_image'] = $request->user_image;
        $get_image = $request->file('user_image');
        
        if($get_image){
            //Get Name Image
            $get_name_image = $get_image->getClientOriginalName();
            //Currenr = final '.'
            //Split string Name - Get Name not .jpg - based on the sign '.'
            $name_image = current(explode('.', $get_name_image));
            //Make copies
            $new_image = $name_image.mt_rand().date_default_timezone_get()
                        .'.'.$get_image->getClientOriginalExtension();
            //Move to folder
            $get_image->move('public/uploads/avatar', $new_image);
            //closing down
            $data['user_image'] = $new_image;

            DB::Table('tbl_user')->where('user_id', $user_id)->update($data);
            Session::put('message','Edit User Success !!!');
            if($request->user_role == 0){
                return Redirect::to('/admin/view-list-user-admin');
            }else if($request->user_role == 1){
                return Redirect::to('/admin/view-list-user-student');
            }else if($request->user_role == 2){
                return Redirect::to('/admin/view-list-user-coordinator');
            }else if($request->user_role == 3){
                return Redirect::to('/admin/view-list-user-manager');
            }else{
                return Redirect::to('/admin/view-list-user-guest');
            }
            
        }
        else{
            $data['user_image'] = '';

            DB::Table('tbl_user')->where('user_id', $user_id)->update($data);
            Session::put('message','Edit User Success but not Image !!!');
            if($request->user_role == 0){
                return Redirect::to('/admin/view-list-user-admin');
            }else if($request->user_role == 1){
                return Redirect::to('/admin/view-list-user-student');
            }else if($request->user_role == 2){
                return Redirect::to('/admin/view-list-user-coordinator');
            }else if($request->user_role == 3){
                return Redirect::to('/admin/view-list-user-manager');
            }else{
                return Redirect::to('/admin/view-list-user-guest');
            }
        }
    }

    public function delete_user($user_id){
        $this->AuthLogin();
        DB::Table('tbl_user')->where('user_id', $user_id)->delete();
        Session::put('message','Delete User Success !!!');
        return Redirect::to('/admin');
    }

    //*************************************** */
    //**********Controller*For*User**********
    //*************************************** */
    public function login_user(Request $request){
        $email = $request->user_email;
        $password = md5($request->user_password);

        $result = DB::Table('tbl_user')->where('user_email', $email)
                                    ->where('user_password', $password)->first();
        
        if($result){
            Session::put('user_id', $result->user_id);
            Session::put('user_fullname', $result->user_fullname);
            Session::put('user_image', $result->user_image);
            Session::put('user_role', $result->user_role);
            return Redirect::to('/');
        }else{
            Session::put('message','Username or Password is wrong, input again !');
            return Redirect::to('/');
        }
    }

    public function logout_user(){
        Session::flush();
        return Redirect::to('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
