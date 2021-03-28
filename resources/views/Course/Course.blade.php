@extends('index')
@section('index_content')
    <div class="container">
        <center><h1>Topic</h1></center>
        <div class="row">
        @foreach($all_course as $key => $cou)            
            <div class="col-sm-4 spacetop">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('public/uploads/course/'.$cou->course_image)}}" alt="course_IMG" class="img-source"  />
                            <h2>{{ $cou -> course_name }}</h2>
                            <p class="shownameproduct">{{ $cou -> course_des }}</p>
                            <?php
							$user_role = Session::get('user_role');
                            $user_id = Session::get('user_id');
							if($user_role == 1){
                            ?>
                            <center><a href="{{URL::to('/assignment/'.$cou->course_id)}}">Submit for Topic</a></center>
                            <?php
                                $user_id = Session::get('user_id');
                                }else if($user_role == 2){
                            ?>
                            <center><a href="{{URL::to('/mark/'.$cou->course_id)}}" style="font-size: 20px; color: red; border-style: dotted solid;">Mark</a></center>
                            <?php
                                }else{
                            ?>
                            <center><a href="#dropdownMenu1"><i class="fa fa-lock"></i>Login to Submit</a></center>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection