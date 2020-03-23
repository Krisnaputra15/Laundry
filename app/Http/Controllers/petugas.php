<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class petugas extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $status = "berhasil login";
        return response()->json(compact('status','token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'telp' => 'required|string|max:12',
            'username' => 'required|string|max:255|',
            'password' => 'required|string|max:12',
            'level' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'nama_petugas' => $request->get('nama_petugas'),
            'telp' => $request->get('telp'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'level' => $request->get('level'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }
    public function update($id,Request $request){
        $get = Auth::user()->id;

        if($get == $id){
            $validator = Validator::make($request->all(),[
                'nama_petugas' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);
            if($validator->fails()){
                return response()->json('invalid input');
            }
            $tayang = user::where('id',$id)->update([
                'nama_petugas' => $request->get('nama_petugas'),
                'telp' => $request->get('telp'),
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
            ]);
            if($tayang){
                $status = "berhasil update data anda";
                return response()->json(compact('status'));
            }
            else{
                $status = "gagal update data anda";
                return response()->json(compact('status'));
            }
        }
        
        else{
            $peringatan = "Anda hanya bisa mengedit data anda sendiri";
            return response()->json(compact('peringatan'));
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

}
