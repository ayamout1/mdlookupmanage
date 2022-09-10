<?php

namespace App\Observers;

use App\Models\PreludeNumber;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class PreludeActionObserver
{
    public function created(PreludeNumber $model)
    {
        $latest = PreludeNumber::latest()->first('number');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Prelude Number', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(PreludeNumber $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $y = count($change)-1;
        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);
        $vendorchangeid = $original['vendor_id'];
        $vendorname = Vendor::where('id',$vendorchangeid)->get('name');

        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name' => 'Prelude', 'vendor'=> $vendorname]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(PreludeNumber $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['number'],'action' => 'Deleted', 'model_name' => 'Prelude Number']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
