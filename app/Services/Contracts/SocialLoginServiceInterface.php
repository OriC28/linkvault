<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

interface SocialLoginServiceInterface {

    /**
     * Generates the authorization URL from the external provider
     * and redirects the user to log in there.
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse;

    /**
     * Receive the authenticated user from the provider after the user
     * grants permissions. Obtain the user's data to log in/register.
     *
     * @return User
     */
    public function callback (): User;
}

?>
