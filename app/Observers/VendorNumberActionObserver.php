<?php

namespace App\Observers;

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
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['number'],'original'=>$original['number'],'action' => 'updated', 'model_name' => 'VendorNumber']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(VendorNumber $model)
    {
        $name = $model->getOriginal();
        $data  = array_merge(['name'=>$name['number'],'action' => 'Deleted', 'model_name' => 'VendorNumber']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }

}
