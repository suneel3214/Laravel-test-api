<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function addUserBooks(Request $request)
    {
         $data = $request->all();
        
          if ($thumbnail_image = $request->file('thumbnail')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $thumbnail_image->getClientOriginalExtension();
            $thumbnail_image->move($destinationPath, $profileImage);
            $data['thumbnail'] = "$profileImage";
          }
          if ($small_thumbnail_image = $request->file('small_thumbnail')) {
            $destinationPaths = 'image/';
            $profileImages = date('h-i-s') . "." . $small_thumbnail_image->getClientOriginalExtension();
            $small_thumbnail_image->move($destinationPaths, $profileImages);
            $data['small_thumbnail'] = "$profileImages";
          }
         $result =  Book::create($data);
         if($result){
            return response('Books added successfully!',200);
         }else{
            return response('Somthing went wrong!',201);
         }
    }


    public function getBooks($id)
    {
        $data =  Book::where('user_id',$id)->orderBy('id', 'DESC')->get();

        return $data;
        
    }

       function update(Request $request, $id) {

       $data = $request->all();
          if ($thumbnail_image = $request->file('thumbnail')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $thumbnail_image->getClientOriginalExtension();
            $thumbnail_image->move($destinationPath, $profileImage);
            $data['thumbnail'] = "$profileImage";
          }
          else{
            unset($data['thumbnail']);
          }
          if ($small_thumbnail_image = $request->file('small_thumbnail')) {
            $destinationPaths = 'image/';
            $profileImages = date('h-i-s') . "." . $small_thumbnail_image->getClientOriginalExtension();
            $small_thumbnail_image->move($destinationPaths, $profileImages);
            $data['small_thumbnail'] = "$profileImages";
          }
         else{
            unset($data['small_thumbnail']);
          }
          $item = Book::where('id',$id)->update($data);
          // $item->update($data);
           return $item;
        }
        
    //   function deleteBook(Request $request,$id){

    //      $data =  Book::where('id',$request->id)->delete();

    //      if($data > 0 ){
    //        return response()->json(['message'=>'Successfully Deleted']);
    //      }
    //      else{
    //       return response()->json(['message'=>'Delete Failed']);
    //     }
    // }

     function deleteBook(Request $request,$id){
        $data = Book::where('id',$request->id)->delete();
      return $data;
    }

}
