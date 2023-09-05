<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class CrudActionObserver
{
    private function getAdminUsers()
    {
        return \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
    }

    private function sendNotification($users, $notification, $data)
    {
        Notification::send($users, new $notification($data));
    }

    public function created(Model $model)
    {
        $modelName = class_basename($model);

        $data = [
            'action' => 'Created',
            'model_name' => $modelName,
            'name' => $model->name,
            // Add other relevant data specific to this model
        ];

        $users = $this->getAdminUsers();
        // Choose the appropriate notification class based on $modelName
        $notificationClass = "App\Notifications\\" . $modelName . "CreateEmailNotification";
        $this->sendNotification($users, $notificationClass, $data);
    }

    public function updated(Model $model)
    {
        $modelName = class_basename($model);

        $changes = $model->getChanges();
        $original = $model->getOriginal();

        $data = [
            'action' => 'Updated',
            'model_name' => $modelName,
            'changes' => $changes,
            'original' => $original,
            // Add other relevant data specific to this model
        ];

        $users = $this->getAdminUsers();
        // Choose the appropriate notification class based on $modelName
        $notificationClass = "App\Notifications\\" . $modelName . "ChangeEmailNotification";
        $this->sendNotification($users, $notificationClass, $data);
    }

    public function deleting(Model $model)
    {
        $modelName = class_basename($model);

        $data = [
            'action' => 'Deleted',
            'model_name' => $modelName,
            'name' => $model->name,
            // Add other relevant data specific to this model
        ];

        $users = $this->getAdminUsers();
        // Choose the appropriate notification class based on $modelName
        $notificationClass = "App\Notifications\\" . $modelName . "DeleteEmailNotification";
        $this->sendNotification($users, $notificationClass, $data);
    }
}
