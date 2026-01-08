<?php

namespace App\Services;

use App\Models\UserPresenceLog;
use Carbon\Carbon;

class PresenceService
{
    public static function markOnline(int $userId, string $type): void
    {
        UserPresenceLog::updateOrCreate(
            [
                'user_id' => $userId,
                'user_type' => $type,
            ],
            [
                'is_online' => true,
                'last_seen_at' => Carbon::now(),
            ]
        );
    }

    public static function markOffline(int $userId, string $type): void
    {
        UserPresenceLog::where([
            'user_id' => $userId,
            'user_type' => $type,
        ])->update([
            'is_online' => false,
            'last_seen_at' => Carbon::now(),
        ]);
    }
}
