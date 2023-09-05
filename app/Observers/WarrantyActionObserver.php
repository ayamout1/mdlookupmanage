<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Warranty;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Auth;
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
        $modelName = get_class($model);
        // or you could use $modelName = $model->getMorphClass();

        // strip the namespace from the class name if necessary
        $modelName = class_basename($modelName);
        $user = Auth::user();

        // rest of your code
        $changes = $model->getChanges();
        $originals = $model->getOriginal();

        $vendorChangeId = $originals['vendor_id'];
        $vendor = Vendor::where('id', $vendorChangeId)->first();

        $changeStrings = [];
        $originalStrings = [];

        foreach ($changes as $key => $value) {
            $changeStrings[] = ucfirst($key) . ": " . $value;
        }

        foreach ($originals as $key => $value) {
            $originalStrings[] = ucfirst($key) . ": " . $value;
        }

        $changeString = implode(PHP_EOL, $changeStrings);
        $originalString = implode(PHP_EOL, $originalStrings);

        $data = [
            'change' => $changeString,
            'original' => $originalString,
            'action' => 'updated',
            'model_name' => $modelName,
            'vendor' => $vendor ? $vendor->name : 'Unknown Vendor',
            'changed_by' => $user->name
        ];

        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();

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
