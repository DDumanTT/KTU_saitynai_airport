<?php

namespace App\Claims;

use CorBosman\Passport\AccessToken;
use Illuminate\Support\Facades\Auth;

class RoleClaim
{
    public function handle(AccessToken $token, $next)
    {
        $token->addClaim('role', Auth::user()->role);
        return $next($token);
    }
}
