<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\Note;
use App\Models\Vendor;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use function PHPUnit\Framework\isNull;

class NoteActionObserver
{
    public function created(Note $model)
    {
        $pdf = $model->getDirty();
        if(!empty($pdf['note'])){
            $latest = Note::latest()->first('note');
            $data  = array_merge(['action' => 'Created', 'model_name' => 'PDF', 'name'=>$latest['note']]);
            $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
            Notification::send($users, new DataCreateEmailNotification($data));

        }else
        $latest = Note::latest()->first('title');
        $data  = array_merge(['action' => 'Created', 'model_name' => 'Note', 'name'=>$latest['title']]);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataCreateEmailNotification($data));
    }

        public function updated(Note $model)
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



    public function deleting(Note $model)
    {
        $original = $model->getOriginal();
        $originalstring =implode(", ",$original);


        $number = $model->getOriginal();

        if(!empty($number['note'])){
            $data  = array_merge(['name'=>$originalstring,'action' => 'Deleted', 'model_name' => 'Note']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
        }

    elseif(!empty($number['title'])){
        $original = $model->getOriginal();
        $originalstring =implode(", ",$original);


        $data  = array_merge(['name'=>$originalstring,'action' => 'Deleted', 'model_name' => 'Note']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
        }
    }
}
