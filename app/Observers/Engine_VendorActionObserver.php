<?php

namespace App\Observers;




use App\Models\Engine;
use App\Models\Engine_Vendor;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class Engine_VendorActionObserver
{

public function created(Engine_Vendor $model){

    $latest = Engine_Vendor::latest()->first();
    $enginechangeid = $latest['engine_id'];
    $vendorchangeid = $latest['vendor_id'];
    $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
    $enginename = Engine::where('id',$enginechangeid)->get('name');

    $data  = array_merge(['action' => 'Engine '.$enginename.' Assigned to '.$vendorname, 'model_name'=> 'Engine Vendor Assignment', 'name'=>$latest]);
    $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
    Notification::send($users, new DataCreateEmailNotification($data));
}
    public function deleting(Engine_Vendor $model){

        $original = $model->getOriginal();


        $enginechangeid = $original['engine_id'];
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
        $enginename = Engine::where('id',$enginechangeid)->get('name');

        $data  = array_merge(['name'=>'Engine '.$enginename.' Vendor '.$vendorname,'action' => ' Deassigned ', 'model_name' => 'Engine Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
