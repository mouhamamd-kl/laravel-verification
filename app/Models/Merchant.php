<?php

namespace App\Models;

use App\Notifications\MerchantEmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;

class Merchant extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    public function sendEmailVerificationNotification()
    {
        $url = URL::temporarySignedRoute(
            'merchant.verification.verify',
            now()->addMinutes(60),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification())
            ]
        );
        $this->notify(new MerchantEmailVerification($url));
    }
    protected $guarded = ["id"];
}
