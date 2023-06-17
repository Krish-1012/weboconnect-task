<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users-List</title>
	
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
	@include('navbar');
<div class="container mt-5 mb-5">
	
<table id="example" class="table-bordered table mt-5" style="width:70%;">
        <thead>
            <tr>
            	<th>Profile-Pic</th>
                <th>First name</th>
                <th>Last name</th> 
                <th>Email</th>
            </tr>
			@foreach ($users as $user)
				<tr>
					<td><img src="{{($user->user_profile_pic != '')?asset($user->user_profile_pic):asset('images/avatar.png')}}" width="50" height="50"></td>
					<td>{{$user->user_first_name}}</td>
					<td>{{$user->user_last_name}}</td>
					<td>{{$user->user_email}}</td>
				</tr>
			@endforeach
        </thead>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="{{asset('validator/dist/jquery.validate.js')}}"></script>
    
</body>
</html>
