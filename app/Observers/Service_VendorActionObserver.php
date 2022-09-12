<?php

namespace App\Observers;




use App\Models\Service;
use App\Models\Service_Vendor;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class Service_VendorActionObserver
{

public function created(Service_Vendor $model){

    $latest = Service_Vendor::latest()->first();
    $servicechangeid = $latest['service_id'];
    $vendorchangeid = $latest['vendor_id'];
    $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
    $servicename = Service::where('id',$servicechangeid)->get('name');

    $data  = array_merge(['action' => 'Service '.$servicename.' Assigned to '.$vendorname, 'model_name'=> 'Service Vendor Assignment', 'name'=>$latest]);
    $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
    Notification::send($users, new DataCreateEmailNotification($data));
}
    public function deleting(Service_Vendor $model){

        $original = $model->getOriginal();


        $servicechangeid = $original['service_id'];
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
        $servicename = Service::where('id',$servicechangeid)->get('name');

        $data  = array_merge(['name'=>'Service '.$servicename.' Vendor '.$vendorname,'action' => ' Deassigned ', 'model_name' => 'Service Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
