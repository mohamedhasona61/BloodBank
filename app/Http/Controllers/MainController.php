<?php

namespace App\Http\Controllers;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Post;
use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\Client;

use Illuminate\Http\Request;


class MainController extends Controller
{

    private function apiResponse ($status,$message,$data=null){

        return $response=[
            'status'=> $status,
            'message'=> $message,
            'data'=> $data,
        ];

    }
    public function governorates(Request $request){
        $governorates = Governorate::all();
        return $this->apiResponse(1 , 'success', $governorates);

    }
  
    public function posts(Request $request)
    {
        $data = $request->all();

        $allPosts = [];
        $filteredBySearch = [];
        $filteredByCategory = [];

        if ($data) {
            if ($request->has('searchPhrase')) {
                $this->validate($request, [
                    'searchPhrase' => 'filled'
                ]);

                $filteredBySearch = Post::where('title', 'LIKE', "%{$data['searchPhrase']}%")
                    ->orWhere('content', 'LIKE', "%{$data['searchPhrase']}%")
                    ->get()->toArray();
            }

            if ($request->has('categoryId')) {
                $this->validate($request, [
                    'categoryId' => 'filled'
                ]);

                $filteredByCategory = Post::where('category_id', $data['categoryId'])->get()->toArray();
            }
        } else {
            $allPosts = Post::all();
        }

        // $filteredPosts = array_merge($filteredBySearch, $filteredByCategory, $allPosts);

        return $this->apiResponse(1, 'success', $allPosts);
    }

    public function singlePost(Request $request)
    {
        $validator=validator()->make($request->all(),['post_id'=>'required|exists:posts,id']);
        if($validator->fails())
        {
            return $this->apiResponse(0,$validator->errors()->first());
        }
        $post = Post::find($request->post_id);
        return $this->apiResponse(1, 'success', $post);
    }

    public function favouritePosts(Request $request)
    {
        $posts = $request->user()->favourites()->paginate();
        
        return $this->apiResponse(1, 'success', $posts);
    }

    public function addToFavourites(Request $request)
    {
        $post = $request->user()->favourites()->toggle($request->post_id);
        return $this->apiResponse(1, 'success', $post);
    }

    public function cities(Request $request){
         $cities=City::where(function($query)use($request){
             if($request->has(key:'governorate_id')){
                 $query->where('governorate_id',$request->$governorate_id);

             }

         })->get();
        $cities = City::all();
        return $this->apiResponse(1, 'success', $cities);

    }
    public function donationRequestCreate(Request $request){
        // RequestLog::Create(['content'=>$request->all(),'service'=>'donation create']);
        $rules=[
            'patient_name'=>'required',
            'patient_age'=>'required:digits',
            'blood_type_id'=>'required|exists:blood_types,id',
            'bags_num'=>'required|:digits',
            'hospital_name'=>'required',
            'hospital_address'=>'required',
            'city_id'=>'required|exists:cities,id',
            'longitude'=>'required',
            'latitude'=>'required',
            

            'patient_phone'=>'required|digits:11',
        ];
        $validator=validator()->make($request->all(),$rules);
        if($validator->fails()){
             return $this->apiResponse(0 , $validator->errors()->first(),$validator->errors());
        }
        $donationRequest=$request->user()->donationRequests()->create($request->all());
        $clientsIds=$donationRequest->city->clients()->whereHas('bloodtypes',function($q)use($request){
            $q->where('blood_type_id',$request->blood_type_id);
        })->pluck('id')->toArray();
        if(count($clientsIds)){
            $notification=$donationRequest->notifications()->create([
                'title'=>'يوجد حاله تبرع قريبه منك',
                'content'=>$donationRequest->blood_type.'محتاج متبرع لفصيله'
            ]);
            $notification->clients()->attach($clientsIds);
            $tokens=Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
            if(count($tokens)){
                $title=$notification->title;
                $body=$notification->content;
                $data=[
                    'donation_request_id'=>$donationRequest->id
                ];
                $send=notifybyfirebase($title ,$body , $tokens,$data);
                return $this->apiResponse(1 ,'تم الاضافه بنجاح',$send);
            }
        }
        return $this->apiResponse(1 ,'تم الاضافه بنجاح',$donationRequest);
        
    }

    public function appSettings(Request $request) {
   
        return $this->apiResponse(1, 'success', Setting::all());
    }

    public function contactUsMsg(Request $request){

        $data = $request->all();
        $data['client_id'] = $request->user()->id;
        $msg = ContactUs::create($data);
        return $this->apiResponse(1, 'success', $msg);
    }
    
public function getAllNotifications(Request $request)
{
    // paginated
    return  $this->apiResponse(1, 'success', $request->user()->notifications);
}

public function updateReadNotification(Request $request, $id)
{
    $request->validate([
        'is_read' => 'required|Boolean'
    ]);

    $notification = $request->user()->notifications()->find($id);
    $notification->pivot->is_read = $request->is_read;
    $notification->save();

    return  $this->apiResponse(1, 'success', $notification);
}

public function getNotificationSettings(Request $request)
{
    $notificationSettings = [
        'choosenBloodTypes' => $request->user()->bloodTypes->pluck('id'),
        'choosenGovernorates' => $request->user()->governorates->pluck('id')
    ];

    return  $this->apiResponse(1, 'success', $notificationSettings);
}

public function updateNotificationSettings(Request $request)
{
    $user = $request->user();

    if ($request->has('governorates')) {
        $governorate_ids = Governorate::whereIn('name', $request->governorates)->pluck('id');

        $user->governorates()->detach();
        $user->governorates()->attach($governorate_ids);
    }

    if ($request->has('bloodTypes')) {
        $bloodType_ids = BloodType::whereIn('name', $request->bloodTypes)->pluck('id');

        $user->bloodTypes()->detach();
        $user->bloodTypes()->attach($bloodType_ids);
    }

    return  $this->apiResponse(1, 'تم تعديل اعدادات الاشعارات بنجاح');
}

}

