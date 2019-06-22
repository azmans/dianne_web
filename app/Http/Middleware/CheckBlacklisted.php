<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBlacklisted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->blacklisted_at) {
            auth()->logout();

            $message = 'Your account has been blacklisted for violating the rules. Please contact our administrator if you have
                any concerns.';

            return redirect()->route('login')->withMessage($message);
        } elseif(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->blacklisted_at) {
            auth()->guard('admin')->logout();

            $message = 'Your account has been blacklisted for violating the rules. Please contact our administrator if you have
                any concerns.';

            return redirect()->route('login')->withMessage($message);
        }



        /*switch($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('admin/dashboard');
                }
                break;
            case 'vendor':
                if (Auth::guard($guard)->check() && !is_null(auth()->guard($guard)->user()->blacklisted_at)) {
                    auth()->guard('vendor')->user()->logout();

                    $message = 'Your account has been blacklisted for violating the rules. Please contact our administrator if you have
                any concerns.';

                    return redirect('vendor.login')->withMessage($message);
                }
                break;
            case 'web':
                if (Auth::check() && !is_null(auth()->user()->blacklisted_at)) {
                    auth()->logout();

                    $message = 'Your account has been blacklisted for violating the rules. Please contact our administrator if you have
                any concerns.';

                    return redirect('auth.login')->withMessage($message);
                }
                break;
        }*/

        return $next($request);
    }
}
