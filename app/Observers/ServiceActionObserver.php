<?php

namespace App\Observers;

use App\Models\Vendor;
use App\Models\Service;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class ServiceActionObserver
{
    public function created(Service $model)
    {
        $latest = Service::latest()->first();
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Service', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Service $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);


        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name'=> 'Service']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Service $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['warranty'],'action' => 'Deleted', 'model_name' => 'Service']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
