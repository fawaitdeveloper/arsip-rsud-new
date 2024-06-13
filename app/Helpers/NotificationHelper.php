<?php

namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper
{
    public static function send($user_id, $title, $description)
    {
        Notification::create([
            'user_id' => $user_id,
            'title' => $title,
            'body' => $description
        ]);
    }
}
