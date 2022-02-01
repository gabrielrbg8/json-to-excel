<?php

namespace App\Observers;

use App\Models\Exportable;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $exportable = new Exportable();
        $exportable->exportable_type = User::class;
        $exportable->exportable_id = $user->id;
        $exportable->save();
    }
}
