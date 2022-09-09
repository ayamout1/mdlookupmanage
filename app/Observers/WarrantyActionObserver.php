<?php

namespace App\Observers;

use App\Models\Warranty;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class WarrantyActionObserver
{
    public function created(Warranty $model)
    {
        $latest = Warranty::latest()->first('warranty');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Warranty', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Warranty $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['warranty'],'original'=>$original['warranty'],'action' => 'updated', 'model_name' => 'Warranty']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Warranty $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['warranty'],'action' => 'Deleted', 'model_name' => 'Warranty']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
