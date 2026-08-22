<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\SocialLoginServiceInterface;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Socialite;
use Override;

class GoogleLoginService implements SocialLoginServiceInterface
{
    /**
     * It generates the authorization URL for the third-party provider
     * and issues a 302 redirect to send the user there.
     *
     * @return RedirectResponse
     */
    #[Override]
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * It intercepts the temporary authorization code sent by the provider,
     * exchanges it behind the scenes for an access token, and parses the
     * authenticated user's profile information.
     *
     * @return User
     */
    #[Override]
    public function callback(): User
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar_url'=> $googleUser->getAvatar(),
                '',
                'last_login_at' => now()
            ]
        );

        return $user;
    }
}

?>
