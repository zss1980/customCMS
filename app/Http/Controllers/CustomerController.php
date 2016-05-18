<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ViewElement;
use App\VEproperty;
use App\Project;
use Mail;
use Input;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataHeader=ViewElement::where('elementName', 'header')->first();
        $dataHeader->companyName = VEproperty::where('element_id', $dataHeader->id)->where('propertyName', 'companyName')->first()->propertyValue;
        $dataHeader->companyFeatures = VEproperty::where('element_id', $dataHeader->id)->where('propertyName', 'companyFeatures')->first()->propertyValue;
        $dataHeader->image = VEproperty::where('element_id', $dataHeader->id)->where('propertyName', 'img')->first()->propertyValue;
        $dataHeader->bgColour = VEproperty::where('element_id', $dataHeader->id)->where('propertyName', 'bgColor')->first()->propertyValue;

        $dataAbout=ViewElement::where('elementName', 'about')->first();
        $dataAbout->aboutInfoLeft = VEproperty::where('element_id', $dataAbout->id)->where('propertyName', 'aboutInfoLeft')->first()->propertyValue;
        $dataAbout->aboutInfoRight = VEproperty::where('element_id', $dataAbout->id)->where('propertyName', 'aboutInfoRight')->first()->propertyValue;
        $dataAbout->downloadLink = VEproperty::where('element_id', $dataAbout->id)->where('propertyName', 'downloadLink')->first()->propertyValue;
        $dataAbout->downloadCaption = VEproperty::where('element_id', $dataAbout->id)->where('propertyName', 'downloadCaption')->first()->propertyValue;
        $dataAbout->bgColour = VEproperty::where('element_id', $dataAbout->id)->where('propertyName', 'bgColor')->first()->propertyValue;

        $dataFooter=ViewElement::where('elementName', 'footer')->first();
        $dataFooter->footerLeftText = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerLeftText')->first()->propertyValue;
        $dataFooter->footerRightText = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerRightText')->first()->propertyValue;
        $dataFooter->footerCentreText = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerCentreText')->first()->propertyValue;
        $dataFooter->footerLeftCaption = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerLeftCaption')->first()->propertyValue;
         $dataFooter->footerRightCaption = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerRightCaption')->first()->propertyValue;
        $dataFooter->footerCentreCaption = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'footerCentreCaption')->first()->propertyValue;
        $dataFooter->copyrightText = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'copyrightText')->first()->propertyValue;
        $dataFooter->bgcolorBottom = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'bgcolorBottom')->first()->propertyValue;
        $dataFooter->bgColour = VEproperty::where('element_id', $dataFooter->id)->where('propertyName', 'bgColor')->first()->propertyValue;

        $allProjects = Project::paginate(6);

        return view('pages.index')->with('data', $dataHeader)->with('dataFooter', $dataFooter)
                                    ->with('dataAbout', $dataAbout)->with('projects', $allProjects);
    }

    public function sendMail(Request $request)
    {
        $viewElem = ViewElement::where('elementName','contacts')->first();
        $emailTo = VEproperty::where('element_id', $viewElem->id)->where('propertyName', 'siteEmail')->first()->propertyValue;
    
    $data = $request->only('name', 'email', 'phone');
    $data['messageLines'] = explode("\n", $request->get('message'));
    $data['emailTo'] = $emailTo;        

     Mail::send('mail.email', $data, function ($message) use ($data) {
      $message->subject('request an appointment from the web-site by: '.$data['name'])
              ->to($data['emailTo'])
              ->from($data['email'], $data['name'])
              ->replyTo($data['email']);
    });

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

    public function getEmail() {
        $viewElem = ViewElement::where('elementName','contacts')->first();

        $email = VEproperty::where('element_id', $viewElem->id)->where('propertyName', 'siteEmail')->first()->propertyValue;
        return $email;
    }

    public function getPropertyValue($request) {
        $viewElem = ViewElement::where('elementName','settings')->first();

        $projectValue = VEproperty::where('element_id', $viewElem->id)->where('propertyName', $request)->first()->propertyValue;
        return $projectValue;
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
