<?php

namespace App\Observers;

use App\Models\Brand_Vendor;

use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Notification;

class Brand_VendorActionObserver
{

public function created(Brand_Vendor $model){
    $change =$model->getChanges();
    $changestring =  implode (", ", $change);
    $data  = array_merge(['change'=>$changestring,'action' => 'Brand Assingned to Vendor', 'model_name'=> 'Brand']);
    $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
    Notification::send($users, new DataCreateEmailNotification($data));
}

}
