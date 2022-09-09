<?php

namespace App\Observers;

use App\Models\Address;
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
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['address'],'original'=>$original['address'],'action' => 'updated', 'model_name' => 'Locations']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Address $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['address'],'action' => 'Deleted', 'model_name' => 'Locations']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
