<?php

namespace App\Observers;

use App\Models\Vendor;
use App\Models\VendorNumber;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class VendorNumberActionObserver
{
    public function created(VendorNumber $model)
    {
        $latest = VendorNumber::latest()->first('number');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'VendorNumber', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(VendorNumber $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $y = count($change)-1;
        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');

        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name' => 'Vendor Number', 'vendor'=> $vendorname]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(VendorNumber $model)
    {
        $original = $model->getOriginal();
        $originalstring =implode(", ",$original);

        $data  = array_merge(['name'=>$originalstring,'action' => 'Deleted', 'model_name' => 'Vendor Number']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
