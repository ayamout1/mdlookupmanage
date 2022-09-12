<?php

namespace App\Observers;

use App\Models\Vendor;
use App\Models\Product;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class ProductActionObserver
{
    public function created(Product $model)
    {
        $latest = Product::latest()->first();
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Product', 'name'=>$latest]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

    public function updated(Product $model)
    {
        $change =$model->getChanges();
        $original =   $model->getOriginal();

        $changestring =  implode (", ", $change);
        $originalstring =implode(", ",$original);


        $data  = array_merge(['change'=>$changestring,'original'=>$originalstring,'action' => 'updated', 'model_name'=> 'Product']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Product $model)
    {
        $number = $model->getOriginal();
        $data  = array_merge(['name'=>$number['warranty'],'action' => 'Deleted', 'model_name' => 'Product']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
    }
}
