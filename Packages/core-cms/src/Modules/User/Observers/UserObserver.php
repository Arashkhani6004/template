<?php

namespace Rahweb\CmsCore\Modules\User\Observers;

use Rahweb\CmsCore\Modules\User\Entities\User;



class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \Rahweb\CmsCore\Modules\User\Entities\User $item
     * @return void
     */
    public function created(User $item)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \Rahweb\CmsCore\Modules\User\Entities\User $item
     * @return void
     */
    public function updated(User $item)
    {


    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \Rahweb\CmsCore\Modules\User\Entities\User $item
     * @return void
     */
    public function deleted(User $item)
    {
            $item->roles()->detach();
        //
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \Rahweb\CmsCore\Modules\User\Entities\User $item
     * @return void
     */
    public function forceDeleted(User $item)
    {
        //
    }
}
