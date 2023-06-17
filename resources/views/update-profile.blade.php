<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webconnect-Update-Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style type="text/css">
      .error{
        color: red;
      }
    </style>
  </head>
  <body>
  	
  	@include('navbar');

    <!-- Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12 mx-auto mt-5">
          <div id="messages"></div>
       <div class="card">
        <div class="card-header bg-primary text-white">
          Update Your Profile
        </div>
        <div class="card-body">
          <form id="updateForm" action="function.php" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="first_name">First Name</label>
              <input type="text" name="first_name" value="{{$userData->user_first_name}}" id="first_name" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label" for="last_name">Last Name</label>
              <input value="{{$userData->user_last_name}}" type="text" name="last_name" id="last_name" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email-ID</label>
              <input readonly type="email" value="<?php echo $userData->user_email;?>" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label" for="profile_pic">Profile-Pic</label>
              <input name="profile_pic" type="file"  class="form-control">
            </div>
            <br>
            <img id="pp" class="mb-3" src="{{($userData->user_profile_pic != '')?asset($userData->user_profile_pic):asset('images/avatar.png')}}" width="70" height="70">
            <div class="d-grid gap-2">
            <input type="submit" name="UpdateProfile" class="btn btn-primary" value="Update">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="{{asset('validator/dist/jquery.validate.js')}}"></script>
     <script type="text/javascript">
      $(document).ready(function() {
          $("#updateForm").validate({
              rules: {
                first_name: {
                  required: true
                },
                last_name: {
                  required: true
                }
              }
            })
          });
  /*Ajax Form Submit*/
$(document).ready(function() {
      $("#updateForm").submit(function(e){
        if(! $(this).valid()){
          return false;
        }
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("Update", "");
        formData.append("id", "<?php echo $userData->id;?>");
        $.ajax({
            type:'POST',
            url: 'update-profile',
            data:formData,
            dataType:'json',
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                $("#messages").html(data.message);
                document.getElementById("pp").src=data.img;
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    });
  });
/*//*/
    </script>
  </body>
</html>