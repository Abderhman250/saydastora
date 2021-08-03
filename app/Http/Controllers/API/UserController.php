<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPoints;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success,'user'=>$user], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'age' => ['required', 'integer'],
            // 'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
                }
        $input = $request->all();
                $input['password'] = bcrypt($input['password']);
                $input['referral_code'] = Str::random(6);
                $user = User::create($input);
                $success['token'] =  $user->createToken('MyApp')-> accessToken;
                $success['user'] =  $user;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
/**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function index()
    {
        $users = User::all()->where('role','user');

        return view('admin.users.index',['users'=>$users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if($user){
        return view('admin.users.edit',['user'=>$user]);

        }
        return view('admin.users');


    }
     public function delete($id)
    {
            $user = User::findOrFail($id);
            if($user){
                $user->delete();
            return redirect('/users')->with('error','User Delete Successfully.');

            }
    }

    public function update(Request $request ,$id)
    {
        $user = User::findOrFail($id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->age = $request->age;
            $user->status = $request->status;

            $user->save();
            return redirect('/users')->with('success','User Update Successfully.');

        }
        return redirect('/users')->with('error','User Update Failed.');


    }

    public function setUserPoint(Request $request)
    {
        if( Auth::user()){
            $points = new UserPoints();
            $points->user_id = Auth::user()->id;
            $points->game_id = $request->game_id;
            $points->points = $request->points;
            $points->save();

            return response()->json(['success' => Auth::user()], $this-> successStatus);

        }
    }
}
