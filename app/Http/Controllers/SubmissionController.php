<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

session_start();

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Submission(Request $request, $course_id)
    {
        $exp = DB::table('tbl_asm')->where('course_id',$course_id)->first();

        $checkTime = Carbon::parse($exp->exp);

        $now = Carbon::now();

        if (Carbon::now()->greaterThan($checkTime)){
            return redirect()->back()->with('failed','Deadline for ubmission');
        }


        $validator = Validator::make($request->all(),[
            'submission_file' => 'required|mimes:docx,doc',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());


        $data = array();
        $data['user_id'] = $request->user_id;
        $data['course_id'] = $request->course_id;
        $data['course_name'] = $request->course_name;
        $data['asm_name'] = $request->asm_name;
        $data['submission_file'] = $request->submission_file;
        $get_image = $request->file('submission_file');
        


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
            $get_image->move('public/uploads/submit', $new_image);
            //closing down
            $data['submission_file'] = $new_image;

            DB::Table('tbl_submission')->insert($data);
            Session::put('message','Submission Success !!!');
            return Redirect::to('/');
        }
        else{
            dd($get_image);
        }
    }

    public function UpateSubmission(Request $request, $course_id)
    {
        $exp = DB::table('tbl_asm')->where('course_id',$course_id)->first();

        $checkTime = Carbon::parse($exp->exp);

        $now = Carbon::now();

        if (Carbon::now()->greaterThan($checkTime)){
            return redirect()->back()->with('failed','Deadline for ubmission');
        }


        $validator = Validator::make($request->all(),[
            'submission_file' => 'required|mimes:docx,doc',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

        $user_id = Session::get('user_id');

        $data = array();
        $data['user_id'] = $request->user_id;
        $data['course_id'] = $request->course_id;
        $data['course_name'] = $request->course_name;
        $data['asm_name'] = $request->asm_name;
        $data['submission_file'] = $request->submission_file;
        $get_image = $request->file('submission_file');
        


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
            $get_image->move('public/uploads/submit', $new_image);
            //closing down
            $data['submission_file'] = $new_image;

            DB::Table('tbl_submission')->where('user_id', $user_id)->where('course_id', $course_id)->update($data);
            Session::put('message','Submission Success !!!');
            return Redirect::to('/');
        }
        else{
            dd($get_image);
        }
    }

    public function index()
    {
        //
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
