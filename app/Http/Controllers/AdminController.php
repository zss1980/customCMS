<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use App\ViewElement;
use App\VEproperty;

class AdminController extends Controller
{
    public function index(){
    	return view ('pages.admin');
    }

    public function section($secName){

    	$sectionName='header';

    	if ($secName=="header") {
			return view ('pages.adminHeader');
    	} elseif ($secName=="about") {
			return view ('pages.adminAbout');
		} elseif ($secName=="footer") {
			return view ('pages.adminFooter');
    	} else {
    		return view ('pages.admin');
    	}
    	

    }

    public function uploadImg(Request $request){

        if ($request->hasFile('imag'))
            { 
                $file = $request->file('imag');
                $rules = array('imag' => 'required',);
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filePath=base_path() . '/public/img/' . $filename;
        
                $file->move(base_path() . '/public/img/', $filename);
                $img= Image::make($filePath);
                $img->resize('300', '300');
                $img->save($filePath);
                 
           }
        
            $response=array();
            $response[0] = "All records are updated! Have a good Day!";
            
            
            if ($request->hasFile('imag')) 
            {
                $response[1]= $filename;
            }
        return $response;
    

    }

    public function uploadObj(Request $request){

        if ($request->hasFile('object'))
            { 
                $file = $request->file('object');
                $rules = array('object' => 'required',);
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filePath=base_path() . '/public/img/' . $filename;
        
                $file->move(base_path() . '/public/img/', $filename);
                /*$img= Image::make($filePath);
                $img->resize('300', '300');
                $img->save($filePath);*/
                 
           }
        
            $response=array();
            $response[0] = "All records are updated! Have a good Day!";
            
            
            if ($request->hasFile('object')) 
            {
                $response[1]= $filename;
            }
        return $response;
    

    }

    public function setView(Request $request){

    	if (ViewElement::where('elementName', $request->parent)->first()){
			$newVE=ViewElement::where('elementName', $request->parent)->first();
    	}else{
    		$newVE = new ViewElement;
	    	$newVE->elementName=$request->parent;
	    	$newVE->save();
    	}

    		

    	$data = $request->except(['parent']);
		foreach($data as $key=>$values)
		{
	    	if (VEproperty::where('element_id', $newVE->id)->where('propertyName', $key)->first()){
	    	
		    	$newVEprop = VEproperty::where('element_id', $newVE->id)->where('propertyName', $key)->first();
		    	$newVEprop->propertyValue = $values;
		    	$newVEprop->save();

	    	} else {
		    	$newVEprop = new VEproperty;
		    	$newVEprop->element_id = $newVE->id;
		    	$newVEprop->propertyName = $key;
		    	$newVEprop->propertyValue = $values;
		    	$newVEprop->save();
    		}
		}



    	//return $request;


    }

    public function getView(Request $viewRequested){
    	$view=ViewElement::where('elementName', $viewRequested->viewName)->first();
    	$veProperties = VEproperty::where('element_id', $view->id)->get();

    	return $veProperties;

    }
}