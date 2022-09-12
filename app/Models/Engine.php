<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Engine extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'engines';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public static function boot()
    {
        parent::boot();
        Engine::observe(new \App\Observers\EngineActionObserver());
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
