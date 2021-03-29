@extends('index')

@push('css')
  <style>
    .comments{
      margin-left:50px;
    }
      .comment-detail-user{
        font-size: 12px;
        color: red;
      }
      .comment-detail-content{
        font-size: 22px;
      }
  </style>
@endpush

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
            <th>File Report</th>
            <th>File Image</th>
            <th>ASM Name</th>
            <th>User Name</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($submission as $key => $sm)
          <tr>
            <td><a href="#">{{ $sm-> submission_file}}</a></td>
            <td><img src="{{asset('public/uploads/submit/'.$sm->image_file)}}" height="100" width="100"></td>
            <td>{{ $sm-> submission_file }}</td>
            <td>{{ $sm-> user_id }}</td>
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
<div class="submissionstatustable">
            <h3>Coomment</h3>
            <div class="comments">
               
            </div>
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
                                                    <input id="message" class="form-control" name="content" rows="2" id="dlg-content-6040dcb9c6a0f" aria-label="Add a comment..." cols="20" style="color: grey;">
                                                </div>
                                                <div class="fd" id="comment-action-6040dcb9c6a0f">
                                                    <a id="comment-action-post-6040d cb9c6a0f" class="save-comment" href="#">Save comment</a>
                                                    <span> | </span>
                                                    <a id="comment-action-cancel-6040dcb9c6a0f" class="cancel-comment" href="#">Cancel</a>
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
@endsection


@push('js')
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
       https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>
  
  <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
      apiKey: "AIzaSyDHK6w0w5xobQi4ubXEcgmQXKxuraMr400",
      authDomain: "project-42d35.firebaseapp.com",
      databaseURL: "https://project-42d35-default-rtdb.firebaseio.com",
      projectId: "project-42d35",
      storageBucket: "project-42d35.appspot.com",
      messagingSenderId: "383196165088",
      appId: "1:383196165088:web:8fee0d9d8745be240db185",
      measurementId: "G-RE90PGDG3H"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  const submission_id = JSON.parse(`{!!$submission!!}`)[0]['submission_id'];
  const user_id = `{!!session('user_id') !!}`;
  
  const database = firebase.database();


  function handle(messages)
  {
      const key = database.ref('messages').push().key;

      database.ref('messages').child(key).set({
        user_id,
        submission_id,
        content: messages,
        'created_at': new Date().toString(),
      })

  } 

  const input = document.querySelector('#message');
  const saveCommentElement = document.querySelector('.save-comment');
  const cancelCommentElement = document.querySelector('.cancel-comment');


  database.ref('messages').orderByChild('submission_id').equalTo(submission_id).on('value',snapshot => {
    const data = snapshot.val();

    let id = new Set();

    for(let item in data){
        id.add(data[item].user_id);
    } 
    
    id = [...id];

    axios.post(`/project/users`,{
      data: id,
    })
    .then(response => {
      const users = response.data;

      
      const findUser = id => {
        id = parseInt(id);
        return users.find(user => user.user_id === id).user_fullname;
      }


      let str= ' ';
      for(let item in data){
        const component = `
        <div class="comment-detail">
                  <div class="comment-detail-user">${findUser(data[item].user_id)}</div>
                  <div class="comment-detail-content">${data[item].content}</div>
                </div>`;

                str += component;
    }

    document.querySelector('.comments').innerHTML = str;

    })
    .catch(err => console.log(err));


  
  })


  input.onkeypress = function(event){
    if (event.keyCode !== 13) return;

    handle(event.target.value);
    input.value = '';
  }

  saveCommentElement.onclick = function(event) {
    event.preventDefault();
    handle(input.value)
    input.value = '';
  }
  

</script>
@endpush