<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use App\ViewElement;
use App\VEproperty;
use App\Project;
use App\User;

class AdminController extends Controller
{
    
public function __construct()
{
    $this->middleware('auth');
}

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
    	} elseif ($secName=="projects") {
			return view ('pages.adminProjects');
    	} elseif ($secName=="contacts") {
			return view ('pages.adminContacts');
    	} elseif ($secName=="settings") {
			return view ('pages.adminSettings');
    	} else {
    		$allUsers = User::all();
    	$count = count($allUsers);
    		return view ('pages.admin')->with('users', $count);
    	}
    	

    }

    public function admProjects(){

    	$allProjects = Project::all();
    	//echo count($allProjects);

    	return $allProjects;
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

    public function getEmailMess() {
    	$viewElem = ViewElement::where('elementName','contacts')->first();

    	$emailMess = VEproperty::where('element_id', $viewElem->id)->where('propertyName', 'siteEmailMessage')->first()->propertyValue;
    	return $emailMess;
    }

public function getProjectName() {
    	if (ViewElement::where('elementName','settings')->first()){
    	$viewElem = ViewElement::where('elementName','settings')->first();

    	$projectName = VEproperty::where('element_id', $viewElem->id)->where('propertyName', 'projectName')->first()->propertyValue;
    	} else {
        	$projectName = 'Setting up...'
        }
    	return $projectName;
    }

    public function getPropertyValue($request) {
        if (ViewElement::where('elementName','settings')->first()){
        $viewElem = ViewElement::where('elementName','settings')->first();

        $projectValue = VEproperty::where('element_id', $viewElem->id)->where('propertyName', $request)->first()->propertyValue;
        } else {
        	$projectValue = 'Setting up...'
        }

        return $projectValue;
    }
     

    public function setProject(Request $request){
    	$isNewProj = false;

    	if ($request->projectId){
			$newProj=Project::find($request->projectId);
    	}else{
    		$newProj = new Project;
	    	$newProj->title=$request->projectTitle;
	    	$isNewProj = true;
	    	
    	}
    	$newProj->description = $request->projectDescription;
    	$newProj->date = $request->projectDate;
    	$newProj->cost = $request->projectCost;
    	$newProj->category = $request->category;
    	$newProj->image = $request->image;
    	$newProj->save();

    	$newProj->state = $isNewProj;

    	return $newProj;


    }

    public function destroyProject(Request $request){

    	Project::destroy($request->id);

    }
}
