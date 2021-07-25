<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Tentative code, I'm asuming you're using the logged-in user ID to obtain the employee
        // Maybe you access it via a relation on the user model
        // Or maybe you're storing the employee ID in the session

        $unseen_notifications = Auth::user()->unreadNotifications->count();
        $view->with(['unseen_notifications' => $unseen_notifications]);
    }
}
