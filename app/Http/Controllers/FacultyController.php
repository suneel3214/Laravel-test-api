<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;       

class FacultyController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

         if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
          }

        $result = Faculty::create($data);
        if($result){
        	return response('Faculty added Successfull !',200);
        }else{
        	return response('Something went to wrong !',401);
        }
    }

      public function getFaculty($id)
    {
        $data =  Faculty::where('user_id',$id)->orderBy('id', 'DESC')->get();

        return $data;
        
    }

    public function FacultyDelete(Request $request,$id){
        $data = Faculty::where('id',$request->id)->delete();
        return $data;
    }
}
