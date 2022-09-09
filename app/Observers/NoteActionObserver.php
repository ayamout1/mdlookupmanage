<?php

namespace App\Observers;

use App\Models\Note;
use App\Notifications\DataChangeEmailNotification;
use App\Notifications\DataCreateEmailNotification;
use App\Notifications\DataDeleteEmailNotification;
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
        $pdf = $model->getDirty();

        if(!empty($pdf['updatedfrom']['note'])){
            $change = $model->getChanges();
            $original =   $model->getOriginal() ;
            $data  = array_merge(['change'=>$change['note'],'original'=>$original['note'],'action' => 'updated', 'model_name' => 'PDF']);
            $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
            Notification::send($users, new DataChangeEmailNotification($data));

        }elseif(isNull($pdf['updatedfrom']['title'])){
        $change = $model->getChanges();
        $original =   $model->getOriginal() ;
        $data  = array_merge(['change'=>$change['title'],'original'=>$original['title'],'action' => 'updated', 'model_name' => 'Note']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
        }
    }

    public function deleting(Note $model)
    {
        $number = $model->getOriginal();

        if(!empty($number['note'])){
        $data  = array_merge(['name'=>$number['note'],'action' => 'Deleted', 'model_name' => 'PDF']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
        }

    elseif(!empty($number['title'])){
        $data  = array_merge(['name'=>$number['title'],'action' => 'Deleted', 'model_name' => 'Note']);
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataDeleteEmailNotification($data));
        }
    }
}
