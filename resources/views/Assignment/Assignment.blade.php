@extends('index')
@section('index_content')
    <section id="region-main" class="col-12">
        <span class="notifications" id="user-notifications"></span>
        <center><h1>Submit Assignment</h1></center>
        <div class="submissionstatustable">
            <h3>Submission status</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif            
            @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed')}}
            </div>
            @endif
            <div class="box boxaligncenter submissionsummarytable">            
                <table class="generaltable">                
                @if(!is_null($submit))
                    @foreach($infor_course as $key => $icou)
                    <form action="{{URL::to('/assignment/submission/edit/'.$icou->course_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <tbody>                        
                            <input type="hidden" name="user_id" value="<?php
                                        $user_id = Session::get('user_id');
                                        echo $user_id;
                                    ?>">
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Course Name:</th>                            
                                <td class="cell c1 lastcol" style="">{{ $icou -> course_name }}</td>
                                <input type="hidden" name="course_id" value="{{ $icou -> course_id }}">  
                                <input type="hidden" name="course_name" value="{{ $icou -> course_name }}">                            
                            </tr>
                            @foreach($assignment as $key => $asm)
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Submit Name:</th>
                                <td class="cell c1 lastcol" name="asm_name" style="">{{ $asm -> asm_name }}</td>
                                <input type="hidden" name="asm_name" value="{{ $asm -> asm_name }}">
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Status Submission:</th>
                                <?php
                                    if($asm->asm_status == 1){
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="1" style="">The submission has not expired yet</td>
                                <?php
                                    }else{
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="0" style="">Deadline for submission</td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Exp date:</th>
                                <td class="cell c1 lastcol" style="">{{ $asm -> exp }}</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Time remaining:</th>
                                <td class="cell c1 lastcol" style="">12 days 3 hours</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="submission_file">File submissions:</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="submission_file" id="submission_file" accept="application/msword"> |
                                    <a href="{{$submit->submission_file}}">{{ $submit->submission_file}}</a>
                                </td>                        
                            </tr>
                            @endforeach
                            <center><button type="submit" class="btn btn-secondary" id="single_button6040dcb9b437233" title="">Reset submission</button></center>
                        </tbody>                    
                    </form>
                    @endforeach
                @else
                @foreach($infor_course as $key => $icou)
                    <form action="{{URL::to('/assignment/submission/'.$icou->course_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <tbody>                        
                            <input type="hidden" name="user_id" value="<?php
                                        $user_id = Session::get('user_id');
                                        echo $user_id;
                                    ?>">
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Course Name:</th>                            
                                <td class="cell c1 lastcol" style="">{{ $icou -> course_name }}</td>
                                <input type="hidden" name="course_id" value="{{ $icou -> course_id }}">  
                                <input type="hidden" name="course_name" value="{{ $icou -> course_name }}">                            
                            </tr>
                            @foreach($assignment as $key => $asm)
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Submit Name:</th>
                                <td class="cell c1 lastcol" name="asm_name" style="">{{ $asm -> asm_name }}</td>
                                <input type="hidden" name="asm_name" value="{{ $asm -> asm_name }}">
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Status Submission:</th>
                                <?php
                                    if($asm->asm_status == 1){
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="1" style="">The submission has not expired yet</td>
                                <?php
                                    }else{
                                ?>
                                <td class="submissionnotgraded cell c1 lastcol" value="0" style="">Deadline for submission</td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Exp date:</th>
                                <td class="cell c1 lastcol" style="">{{ $asm -> exp }}</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row">Time remaining:</th>
                                <td class="cell c1 lastcol" style="">12 days 3 hours</td>
                            </tr>
                            <tr class="">
                                <th class="cell c0" style="" scope="row" id="submission_file">File submissions:</th>
                                <td class="cell c1 lastcol" style="">
                                    <input type="file" name="submission_file" id="submission_file" accept="application/msword">
                                </td>                        
                            </tr>
                            @endforeach
                            <center><button type="submit" class="btn btn-secondary" id="single_button6040dcb9b437233" title="">Add submission</button></center>
                        </tbody>
                    </form>
                    @endforeach                    
                @endif
                </table>                
            </div>            
        </div>
        
        <div class="submissionstatustable">
            <h3>Coomment</h3>
            <div class="box boxaligncenter submissionsummarytable">
                <table class="generaltable">
                    <tbody>
                        <tr class="lastrow">
                            <th class="cell c0" style="" scope="row">Submission comments</th>
                            <td class="cell c1 lastcol" style="">
                                <div class="box boxaligncenter plugincontentsummary summary_assignsubmission_comments_224587">                        
                                    <div class="mdl-left">
                                        <a class="showcommentsnonjs" href="#">Show comments</a>
                                        <a class="comment-link" id="comment-link-6040dcb9c6a0f" href="#" role="button" aria-expanded="false">
                                            <i class="icon fa fa-caret-right fa-fw " title="Comments" aria-label="Comments"></i>
                                            <span id="comment-link-text-6040dcb9c6a0f">Comments (0)</span>
                                        </a>
                                        <div id="comment-ctrl-6040dcb9c6a0f" class="comment-ctrl">
                                            <ul id="comment-list-6040dcb9c6a0f" class="comment-list">
                                                <li class="first"></li>
                                            </ul>
                                            <div class="comment-area">
                                                <div class="db">
                                                    <textarea name="content" rows="2" id="dlg-content-6040dcb9c6a0f" aria-label="Add a comment..." cols="20" style="color: grey;"></textarea>
                                                </div>
                                                <div class="fd" id="comment-action-6040dcb9c6a0f">
                                                    <a id="comment-action-post-6040d cb9c6a0f" href="#">Save comment</a>
                                                    <span> | </span>
                                                    <a id="comment-action-cancel-6040dcb9c6a0f" href="#">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>         
        </div>
    </section>    
@endsection