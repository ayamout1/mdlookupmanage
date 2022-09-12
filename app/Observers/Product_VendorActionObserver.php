<?php

namespace App\Observers;


use App\Models\Product;
use App\Models\Product_Vendor;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class Product_VendorActionObserver
{

public function created(Product_Vendor $model){

    $latest = Product_Vendor::latest()->first();
    $productchangeid = $latest['product_id'];
    $vendorchangeid = $latest['vendor_id'];
    $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
    $productname = Product::where('id',$productchangeid)->get('name');

    $data  = array_merge(['action' => 'Product '.$productname.' Assigned to '.$vendorname, 'model_name'=> 'Product Vendor Assignment', 'name'=>$latest]);
    $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
    Notification::send($users, new DataCreateEmailNotification($data));
}
    public function deleting(Product_Vendor $model){

        $original = $model->getOriginal();


        $productchangeid = $original['product_id'];
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');
        $productname = Product::where('id',$vendorchangeid)->get('name');

        $data  = array_merge(['name'=>'Product '.$productname.' Vendor '.$vendorname,'action' => ' Deassigned ', 'model_name' => 'Product Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
