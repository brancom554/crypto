<?php

namespace App\Http\Middleware;

use App\Models\KYC;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckKYC
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
        if($status = KYC::where('userId',Auth::user()->id)->exists()){
            $status = KYC::where('userId',Auth::user()->id)->first();
            if ($status->status != 'approved') {
                $notify[] = ['warning', 'Verify your identify first!'];
                return $request->expectsJson()
                    ? abort(403, 'Your Identity is not verified.')
                    : redirect()->route('user.kyc')->withNotify($notify);
            }
        } else {
            $notify[] = ['warning', 'Verify your identify first!'];
            return $request->expectsJson()
                ? abort(403, 'Your Identity is not verified.')
                : redirect()->route('user.kyc')->withNotify($notify);
        }

        return $next($request);
    }
}
