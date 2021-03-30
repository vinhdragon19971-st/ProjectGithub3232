@extends('index')
@section('index_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List mark
    </div>
    <div class="table-responsive">
      <?php
        $message = Session::get('message');
        if($message){
          echo '<center><span class="text-alert">'.$message.'</span></center>';
          Session::put('Message',null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>List Submission</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <td><a href="#">{{ $sm->submission_file}}</a></td>            
            <td>
              <a href="{{URL::to('/mark/details-mark/'.$sm->submission_id)}}"
                  class="active styling-edit" ui-toggle-class="">
                Details</a>
            </td>
            <td>
              <a href="{{URL::to('/mark/preview-mark/')}}"
                  class="active styling-edit" ui-toggle-class="">
                Preview</a>
            </td>
            <td>
              <form action="" method="post">
                @csrf
                <td><input type="number" name="mark_student" id="">Mark for student</td>
              </form>
            </td>
          </tr>  
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection