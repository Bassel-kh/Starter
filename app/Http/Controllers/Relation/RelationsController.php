<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Service;
use Illuminate\Http\Request;


class RelationsController extends Controller
{
    public function hasOneRelation(){
//        $user =\App\User::find(5); //or \App\User::where('id',15)->first();
//        return $user -> phone;
//        $phone = user -> phone; // error

//        $user =\App\User::with('phone')->find(5);
            $user =\App\User::with(['phone' =>function($q){
                    $q ->select('code', 'phone','user_id');
                }])->find(5);

//            return $user -> phone -> code;

        return response() ->json($user);
    }

    public function hasOneRelationReverse(){
         $phone = \App\Models\Phone::find(0);

        // Make some attribute Visible
        $phone ->makeVisible(['user_id']);
        // $phone ->makeHidden(['code']);
        // return $phone -> user; // return user of this phone number
        // get all data phone + user
        $phone = \App\Models\Phone::with('user')-> find(0);


        // get custom data phone + user
        $phone =\App\Models\Phone::with(['user' =>function($q){
            $q ->select('email', 'name','id');
        }])->find(0);
        return $phone;

    }

    ################# One to One Relation Method ##################
    public function getUserHasPhone(){
        $user = \App\User::whereHas('phone') -> get();
        return $user;
    }

    public function getUserNotHasPhone(){
        return \App\User::whereDoesntHave('phone') -> get();

    }

    public function getUserWhereHasPhoneWithCondition(){

        $user = \App\User::whereHas('phone', function ($q){
            $q -> where('code','963');
        }) -> get();

        return $user;
    }

    ################### Begin One To Many Relation Method ##############
    public function getHospitalDoctors()
    {
        $hospital = \App\Models\Hospital::find(1);  // Hospital::where('id',1) -> first();  //Hospital::first();

        // return  $hospital -> doctors;   // return hospital doctors

        $hospital = \App\Models\Hospital::with('doctors')->find(1);
        //return  $hospital;
        //return $hospital -> name;


        $doctors = $hospital->doctors;

//        foreach ($doctors as $doctor){
//            echo  $doctor -> name.'<br>';
//         }

        $doctor = \App\Models\Doctor::find(2);

        return $doctor->hospital->name;


    }

    public function hospitals(){
//        $hospitals = \App\Models\Hospital::get();
        $hospitals = \App\Models\Hospital::select('id','name','address') -> get();

        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id){
        // should have validation


        $hospital = \App\Models\Hospital::find($hospital_id);
        $doctors = $hospital -> doctors;

        return view('doctors.doctors', compact('doctors'));

    }

    // get all hospitals which must have doctors
    public function hospitalsHasDoctors(){
        $hospitals = \App\Models\Hospital::whereHas('doctors')->get();
        return view('doctors.hospitals', compact('hospitals'));

    }
    // get all hospitals which must have only male doctors
    public function hospitalsHaveOnlyMaleDoctors()
    {
        return  $hospitals = \App\Models\Hospital::whereHas('doctors', function ($q){
            $q -> where('gender', 1);
        })->with('doctors')->get();

//        $hospitals = \App\Models\Hospital::whereHas('doctors', function ($q){
//            $q -> where('gender', 1);
//        })->get();
//        return view('doctors.hospitals', compact('hospitals'));

    }

    // get hospitals which don't have doctors
    public function hospitalsDontHaveDoctors(){
       return $hospitals = \App\Models\Hospital::whereDoesntHave('doctors')-> get();
    }

    ############Delete Methods ##############
    public function deleteHospital($hospital_id){
        $hospital = Hospital::find($hospital_id);

        if(!$hospital)
            abort('404');
       // Note: $hospital -> delete(); // Wrong method becuse it has one to many relationship

        # Steps to delete Hospital
        #step 1
        // Delete doctors in this hospital
        $hospital -> doctors() -> delete();
        #step
        // Delete  hospital
        $hospital -> delete();

        return redirect() -> route('hospital.all');
    }

    ################### End One To Many Relation Method ##############
//////////////////////////////////////////////////////////////////////////
    ################### Begin Many To Many Relation Method ##############
    public function getDoctorServices(){
//         $doctor = Doctor::find(1);
//        return $doctor ->services;
        return $doctor = Doctor::with('services')->find(1);

    }
    public function getServiceDoctors(){
//        $doctors = Service::find(1);
//        return $doctors -> doctors;

//        return $doctors = Service::with('doctors')->find(1);
        return $doctors = Service::with(['doctors' => function($q){
            $q -> select('doctors.id','name','title');
        }])->find(1);
    }

    public function getDoctorServicesById($doctor_id){
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;  //doctor services

        $doctors = Doctor::select('id', 'name')->get();
        $allServices = Service::select('id', 'name')->get(); // all db serves

        return view('doctors.services', compact('services', 'doctors', 'allServices'));
    }

    public function saveServicesToDoctors(Request $request)
    {

        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort('404');
        // $doctor ->services()-> attach($request -> servicesIds);  // many to many insert to database
        $doctor ->services()-> sync($request -> servicesIds);
//        $doctor->services()->syncWithoutDetaching($request->servicesIds);
        return 'success';
    }

    public function getPatientDoctor(){
         $patient = \App\Models\Patient::find(1);

        return $patient -> doctor;
    }

    ################### End Many To Many Relation Method ##############

}
