<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Support\Facades\Mail;
use App\Mail\Resetpassword;


class AuthController extends Controller
{

    private function apiResponse($status,$message,$data=null){

        return $response=[
            'status'=> $status,
            'message'=> $message,
            'data'=> $data,
        ];

    }
    public function register(Request $request){
        $validator =validator()->make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|unique:clients',
            'd_o_b'=> 'required',
            'blood_type_id'=> 'required',
            'last_donation_date'=> 'required',
            'city_id'=> 'required',
            'mobile_num'=> 'required',
            'password'=> 'required|confirmed',

        ]);
        if($validator->fails()){
            return $this->apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $governorate_id = City::where('id', $request->city_id)->pluck('governorate_id');
        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(40);
        $client->save();
        $client->governorates()->attach($request->governorate_id);
        $client->bloodTypes()->attach($request->bloodType);
        return $this->apiResponse(1, 'تم الاضافه بنجاح', [
            'api_token'=> $client->api_token,
            'client'=> $client

        ]);
    }
    public function login(Request $request){
        $validator =validator()->make($request->all(),[
            'mobile_num'=> 'required',
            'password'=> 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(0, $validator->errors()->first(), $validator->errors());
        }
        $client=Client::where('mobile_num',$request->phone)->first();
        if($client)
        {
            if(Hash::check($request->password, $client->password))
            {
                return $this->apiResponse(1, 'تم تسجيل الدخول', [
                    'api_token'=> $client->api_token,
                    'client'=> $client

                ]);

            }else{
                return $this->apiResponse(0,'بيانات الدخول غير صحيحه');
            }


        }else{
            return $this->apiResponse(0,'بيانات الدخول غير صحيحه');
        }
     
    }
   public function profile(Request $request){
    $loginUser=$request->user();
      $validation =validator()->make($request->all(),[
          'password'=>'confirmed',
          'email'=>'required|unique:clients,email,'.$loginUser->id,
          'mobile_num'=>'required|unique:clients,mobile_num,'.$loginUser->id,
      ]);
      if($validation->fails()){
        return $this->apiResponse(0, $validation->errors()->first());
      }
     
      $loginUser->update($request->all());
      if($request->has('password'))
      {
     $loginUser->password =bcrypt($request->password);
      }
      $loginUser->save();
      if($request->has('governorate_id'))
      {
         $loginUser->cities()->detach($request->city_id);
         $loginUser->cities()->attach($request->city_id);
      }
      if($request->has('blood_type'))
      {
          $bloodType=BloodType::where('name',$request->blood_type)->first();
         $loginUser->bloodTypes()->detach($request->$bloodType->id);
         $loginUser->bloodTypes()->attach($request->$bloodType->id);
      }
       
        return $this->apiResponse(1, 'تم تحديث البيانات' );
}

     public function Resetpassword(Request $request){
        $validation =validator()->make($request->all(),[
           'mobile_num'=>'required'
        ]);
        if($validation->fails()){
            $data =$validation->errors();
            return $this->apiResponse(0, $validation->errors()->first() ,$data);
        }
        $user= Client::where('mobile_num', $request->mobile_num)->first();
        if($user){
            $code=rand(1111,9999);
            $update=$user->update(['pin_code'=>$code]);
            if($update){

                Mail::to($user->email)
                ->bcc("hasonamohamed033@gmail.com")
                ->send(new ResetPassword($user));

                return $this->apiResponse(1, 'برجاء فحص هاتفك' ,['client'=>$user]);
            }else{
                return $this->apiResponse(0, 'حدث خطا حاول مره اخري');
            }
        }else{
            return $this->apiResponse(0, 'لا يوجد اي حساب مرتبط بهذا الرقم');
        }
     }
      public function forgetpassword(Request $request){ 
        $validation =validator()->make($request->all(),[
            'pin_code'=>'required',
            'password'=>'confirmed|required'
         ]);
         if($validation->fails()){
            $data =$validation->errors();
            return $this->apiResponse(0, $validation->errors()->first() ,$data);
        }
        $user =Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)->first();
        if($user){
            $user->password =bcrypt($request->password);
            $user->pin_code=null;

            if($user->save()){
                return $this->apiResponse(1 , 'نم تغيير كلمه المرور بنجاح');

            }else{
                return $this->apiResponse(0 , 'حدث خطا حاول مره اخري');

            }
        }else{
                return $this->apiResponse(0 , 'هذا الكؤد غير صالح');
            }
        }
       
      

        public function RegisterToken(Request $request){
            $validation=validator()->make($request->all(),[
                'token'=>'required',
                'platform'=>'required|in:android,ios',
            ]);
            if($validation->fails()){
                $data=$validation->errors();
                return $this->apiResponse(0 , $validation->errors()->first(),$data);       
         }
         Token::where('token',$request->token)->delete();
         $request->user()->tokens()->create($request->all());
         return $this->apiResponse(1 , 'تم التسجيل بنجاح');

        }

        public function RemoveToken(Request $request){
            $validation=validator()->make($request->all(),[
                'token'=>'required',
            ]);
            if($validation->fails()){
                $data=$validation->errors();
                return $this->apiResponse(0 , $validation->errors()->first(),$data);       
         }
         Token::where('token',$request->token)->delete();
         return $this->apiResponse(1 ,'تم الحذف بنجاح');
        }
        public function logout(Request $request){
            auth()->guard('api')->user()->tokens()->delete();
            return $this->apiResponse(1, 'logged out successfully');
        }
    }