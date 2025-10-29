<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Response’ı al
        $response = $next($request);

        // After response: Auth kontrolünü buraya taşı
        if (Auth::check()) {
            try {
                UserActivity::create([
                    'user_id' => Auth::id(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } catch (\Exception $e) {
                Log::error('LogUserActivity Hata: '.$e->getMessage());
            }
        }

        return $response;
    }
}
