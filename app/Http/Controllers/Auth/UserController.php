<?php
 
namespace App\Http\Controllers\Auth;
 
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
 
    public $successStatus = 200;
 
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json($success, $this->successStatus);
        } else {
            return response()->json(['error'=>'Credenciais inválidas'], 401);
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
 
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
 
        return response()->json(['success'=>$success], $this->successStatus);
    }
 
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], $this->successStatus);
    }
 
    public function logout()
    {
        $user = Auth::user()->token()->revoke();
        // Auth::logout();
         
        return response()->json(['user' => $user], $this->successStatus);
    }
}
