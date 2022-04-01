<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function service(){
        $allservices = ServiceType::all();
        $service = null;
        return view('serviceType',['services'=>$allservices,'editservice'=>$service]);
    }
    public function addservice(Request $request){
        $newservice = new ServiceType();
        $newservice->name = $request->service;
        $newservice->save();
        return redirect()->route('service');
    }
    public function destroyservice($id){
        $service = ServiceType::find($id);
        $service->delete();
        return redirect()->route('service');
    }
    public function editservice($id){
        $service = ServiceType::find($id);
        $allservices = ServiceType::all();
        return view('serviceType',['services'=>$allservices,'editservice'=>$service]);
    }
    public function eservice(Request $request,$id){
        $newservice = ServiceType::find($id);
        $newservice->name = $request->service;
        $newservice->save();
        return redirect()->route('service');
    }
}
