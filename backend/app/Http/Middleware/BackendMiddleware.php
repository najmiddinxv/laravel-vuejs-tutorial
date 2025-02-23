<?php

namespace App\Http\Middleware;

use App\Enums\UserEnum;
use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class BackendMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
            // if (auth()->user()->status === User::STATUS_ACTIVE && auth()->user()->user_type === User::USER_TYPE_BACKEND) {
            if (auth()->user()->status === UserStatus::STATUS_ACTIVE->value && auth()->user()->user_type === UserType::USER_TYPE_BACKEND->value) {
                return $next($request);
            }else{
                Session::flush();
                Auth::logout();
                return back()->with('error','Access Denied');
                // return redirect()->route('frontend.index');
                // return redirect()->route('backend.auth.login')->with('error','Access Denied');

            }
        }else{
            return redirect()->route('backend.auth.login');
            // return redirect()->route('frontend.index')->with('error','Invalid login credentials.');
        }
    }
}
