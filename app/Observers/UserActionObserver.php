<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class UserActionObserver
{
    public function created(User $model)
    {
        $latestuser = User::latest()->first('name');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'User', 'name'=>$latestuser]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(User $model)
    {
        $data  = array_merge([$model->getChanges()],[$model->getOriginal()],['action' => 'updated', 'model_name' => 'User']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(User $model)
    {
        $data  = array_merge([$model->getOriginal()],['action' => 'Deleted', 'model_name' => 'User']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
