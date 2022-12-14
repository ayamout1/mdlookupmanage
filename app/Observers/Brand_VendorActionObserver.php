<?php

namespace App\Observers;


use App\Models\Brand;
use App\Models\Brand_Vendor;

use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class Brand_VendorActionObserver
{

public function created(Brand_Vendor $model){

    $latest = Brand_Vendor::latest()->first();
    $brandchangeid = $latest['brand_id'];
    $vendorchangeid = $latest['vendor_id'];
    $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
    $brandname = Brand::where('id',$brandchangeid)->get('name');

    $data  = array_merge(['action' => 'Brand '.$brandname.' Assigned to '.$vendorname, 'model_name'=> 'Brand Vendor Assignment', 'name'=>$latest]);
    $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
    Notification::send($users, new DataCreateEmailNotification($data));
}
    public function deleting(Brand_Vendor $model){

        $original = $model->getOriginal();


        $brandchangeid = $original['brand_id'];
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
        $brandname = Brand::where('id',$brandchangeid)->get('name');

        $data  = array_merge(['name'=>'Brand '.$brandname.' Vendor '.$vendorname,'action' => ' Deassigned ', 'model_name' => 'Brand Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
