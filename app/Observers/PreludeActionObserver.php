<?php

namespace App\Observers;

use App\Models\PreludeNumber;
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
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['number'],'original'=>$original['number'],'action' => 'updated', 'model_name' => 'Prelude Number']);
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
