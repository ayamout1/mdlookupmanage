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
        $data  = array_merge(['action' => 'Created', 'model_name' => 'User', 'name'=>$latestuser,'vendor'=>'This is a User Action']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(User $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $y = count($change)-1;
        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);

        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name' => 'User', 'vendor'=> 'This is a User update']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(User $model)
    {
        $original = $model->getOriginal();
        $originalstring =implode(", ",$original);

        $data  = array_merge(['name'=>$originalstring,'action' => 'Deleted', 'model_name' => 'User']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
