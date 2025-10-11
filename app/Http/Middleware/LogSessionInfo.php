<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogSessionInfo
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Request: ' . $request->method() . ' ' . $request->path());
        Log::info('Session ID: ' . session()->getId());
        Log::info('Auth check: ' . (Auth::check() ? 'true' : 'false'));
        Log::info('Auth ID: ' . Auth::id());
        Log::info('Session data: ' . json_encode(session()->all()));
        
        return $next($request);
    }
}
