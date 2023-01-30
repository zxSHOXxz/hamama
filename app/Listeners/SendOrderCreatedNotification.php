<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Notifications\OrderCreatedNotification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $users = Admin::all();
        $orders = $event->orders;
        foreach ($users as $user) {
            $user->notify(new OrderCreatedNotification($orders));
        }
    }
}