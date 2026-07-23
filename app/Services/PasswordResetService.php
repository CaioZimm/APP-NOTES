<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasswordResetService
{
    public function createToken(string $email): string
    {
        $token = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        return $token;
    }

    public function isValidToken(string $email, string $token): bool
    {
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record) {
            return false;
        }

        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return false;
        }

        return Hash::check($token, $record->token);
    }
}
