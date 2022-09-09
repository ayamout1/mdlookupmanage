<?php

namespace App\Observers;

use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class VendorActionObserver
{
    public function created(Vendor $model)
    {
        $latest = Vendor::latest()->first('name');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Vendor', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Vendor $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['name'],'original'=>$original['name'],'action' => 'updated', 'model_name' => 'Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Vendor $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['name'],'action' => 'Deleted', 'model_name' => 'Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
