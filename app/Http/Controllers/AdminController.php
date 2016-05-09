<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use App\ViewElement;
use App\VEproperty;
use App\Project;

class AdminController extends Controller
{
    public function index(){
    	return view ('pages.admin');
    }

    public function section($secName){

    	if ($secName=="header") {
			return view ('pages.adminHeader');
    	} elseif ($secName=="about") {
			return view ('pages.adminAbout');
		} elseif ($secName=="footer") {
			return view ('pages.adminFooter');
    	} elseif ($secName=="pview") {
			return view ('pages.adminProjectView');
    	} elseif ($secName=="padd") {
			return view ('pages.adminProjectAdd');
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
                if ($request->height) {
                	$img->resize($request->height, $request->width);
                } 
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
		    	if (is_array($values))
		    	{
		    		$newVEprop->propertyValue = serialize($values);
		    	} else {
		    		$newVEprop->propertyValue = $values;
		    	}
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
    	foreach($veProperties as $values)
		{
			if ($values->propertyName == 'options') {
				$values->propertyValue = unserialize($values->propertyValue);
			}
		}

    	return $veProperties;

    }

    public function setProject(Request $request){

    	if (Project::where('title', $request->projectTitle)->first()){
			$newProj=Project::where('title', $request->projectTitle)->first();
    	}else{
    		$newProj = new Project;
	    	$newProj->title=$request->projectTitle;
	    	
    	}
    	$newProj->description = $request->projectDescription;
    	$newProj->date = $request->projectDate;
    	$newProj->cost = $request->projectCost;
    	$newProj->category = $request->category;
    	$newProj->image = $request->image;
    	$newProj->save();

    	return $newProj->id;


    }
}
