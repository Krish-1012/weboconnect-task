<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
class UserController extends Controller
{
   public function index()
   {
       return view('registration');
   }

   public function handleRegistration(Request $req){
    if($req->post()){
        $validator = Validator::make($req->all(), [
            'user_first_name' => 'required',
            'user_last_name' => 'required',
            'user_email' => 'required|unique:users|max:255'
        ]);
        
        if($validator->fails()){
            $errors = $validator->errors();
            $str = '';
            foreach ($errors->all() as $error) {
                $str.= $error;
            }
            return response()->json([
                'message' => $this->getAlert('danger','Form Errors', $str)
            ],200);
        }
        $user = new User;
        $user->user_first_name = $req->user_first_name;
        $user->user_last_name = $req->user_last_name;
        $user->user_email = $req->user_email;
        $user->user_profile_pic = '';
        $user->save();
        return response()->json([
            'message' => $this->getAlert('success','Success', 'User Register Successfully')
        ],200);
    }
   }

   public function login(Request $request){
    if($request->post()){
      $email = $request->email;
      $user = User::where('user_email', $email)->get()->first();
      if($user){
        $view = View::make('qr', [
            'data' => $user->id
        ]);
        return $view;
      }
      else{
        return response()->json([
            'alert' => $this->getAlert('danger','Not Found', 'Email Not Found')
        ]);
      }
    }
    else{
        return view('login');
    } 
   }

   public function updateProifle(Request $req){
    if($req->post()){
       // dd($req->all());
        $user = User::find($req->id);
        $user->user_first_name = $req->first_name;
        $user->user_last_name = $req->last_name;
        if($req->profile_pic){
            $user->user_profile_pic = $req->file('profile_pic')->store('images');
        }
        $user->save();
        return response()->json([
            'message' => $this->getAlert('success','Updated', 'User Updated Successfully'),
            'img'=> asset($user->user_profile_pic)
        ],200);
    }
    else{
        $user_id = $req->id;
        $data['userData'] = User::where('id', $user_id)->get()->first();
        return view('update-profile',$data);
    }
    
   }


function usersList(){
    $data['users'] = User::all();
    return view('users-list',$data);
}

   function getAlert($alertType,$alertIndicator,$alertMessage){
      $component =   '<div class="alert alert-'.$alertType.' alert-dismissible fade show" role="alert">
        <strong>'.$alertIndicator.'</strong>'.$alertMessage.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       return $component;
   }
}
