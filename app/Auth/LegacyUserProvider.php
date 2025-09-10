<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class LegacyUserProvider extends EloquentUserProvider
{
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain  = (string)($credentials['password'] ?? '');
        $stored = (string)($user->sifre ?? $user->getAuthPassword());

        if ($stored === '') return false;

        // Accept MD5 (32 hex) or plaintext
        if (strlen($stored) === 32 && ctype_xdigit($stored)) {
            return hash_equals(strtolower($stored), md5($plain));
        }
        return hash_equals($stored, $plain);
    }

    /**
     * Override to prevent Laravel from rehashing & saving a password.
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, $force = false)
    {
        // no-op: never write hashed passwords to legacy DB
    }
}
