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
        $latestvendor = Vendor::latest()->first('name');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Vendor', 'name'=>$latestvendor]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Vendor $model)
    {
        $data  = array_merge([$model->getChanges()],[$model->getOriginal()],['action' => 'updated', 'model_name' => 'Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Vendor $model)
    {
        $data  = array_merge([$model->getOriginal()],['action' => 'Deleted', 'model_name' => 'Vendor']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
