<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\SocialLoginServiceInterface;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\InvalidStateException;

class GoogleController extends Controller
{
    public function __construct(
        private SocialLoginServiceInterface $socialLogin
    ) {}

    public function redirect()
    {
        return $this->socialLogin->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $user = $this->socialLogin->callback();
            Auth::login($user);
            $request->session()->regenerate();

            return redirect(route('dashboard'));
        } catch (InvalidStateException | ClientException $e) {
            return redirect(route('login'))->with('error', 'Falló la autenticación con Google. Inténtalo de nuevo.');
        }
    }
}
