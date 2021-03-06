<?php

namespace App\ModelFilters;

use App\Constants\Constants;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Auth;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function name($value)
    {
        return $this->where('name', 'LIKE', "%$value%");
    }

}
