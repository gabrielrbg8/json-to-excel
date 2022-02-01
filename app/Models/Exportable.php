<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTransform;
use EloquentFilter\Filterable;

class Exportable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exportable_id',
        'exportable_type',
        'exported'
    ];

    public function exportable()
    {
        return $this->morphTo();
    }
}
