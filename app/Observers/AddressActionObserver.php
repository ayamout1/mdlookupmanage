<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class AddressActionObserver
{
    public function created(Address $model)
    {
        $latest = Address::latest()->first('address');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Locations', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Address $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $y = count($change)-1;
        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');

        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name' => 'Locations', 'vendor'=> $vendorname]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Address $model)
    {
        $original = $model->getOriginal();
        $originalstring =implode(", ",$original);

        $data  = array_merge(['name'=>$originalstring,'action' => 'Deleted', 'model_name' => 'Address']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
