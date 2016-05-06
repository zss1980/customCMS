<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
    	return view ('pages.admin');
    }

    public function uploadImg(Request $request){

        /*$mpobject = Mpobject::find($request->input('id'));
        $mpobject_caption=$mpobject->entries()->where('record_id', $mpobject->id)
                                                                ->where('element_id', 'caption')
                                                                ->first();
            $mpobject_caption->text = $request->input('caption');
            $mpobject_caption->save();
        $mpobject_info=$mpobject->entries()->where('record_id', $mpobject->id)
                                                                ->where('element_id', 'info')
                                                                ->first();
            $mpobject_info->text = $request->input('info');
            $mpobject_info->save();*/
            
        if ($request->hasFile('imag'))
            { 
                $file = $request->file('imag');
                $rules = array('imag' => 'required',);
                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/public/img/', $filename);
                //image to DB
                /*$image = $mpobject->imageEntry()->where('record_id', $mpobject->id)
                                                ->where('record_type', $mpobject->record_type)
                                                ->first();
                 $image->filename=$filename;
                 $image->save();*/
           }
        $data1=-1;
            //$data1 = $request->hasFile('imag');
            $response=array();
            $response[0] = "All records are updated! Have a good Day!";
            
            
            if ($request->hasFile('imag')) 
            {
                $response[1]= $filename;
            }
        return $response;
    

    }
}
