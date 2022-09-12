<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'products';

    public static $searchable = [
        'name',
        'product_misc',
        'major_group',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'product_misc',
        'major_group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public static function boot()
    {
        parent::boot();
        Product::observe(new \App\Observers\ProductActionObserver());
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
