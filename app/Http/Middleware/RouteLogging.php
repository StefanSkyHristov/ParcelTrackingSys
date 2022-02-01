<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RouteLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        
    }

    public function terminate($request)
    {
        $this->log($request);
    }

    protected function log($request)
    {
        $userId = request()->user() ? request()->user()->id : request()->user();
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $status = response()->json()->getStatusCode();
        $log = "{$userId}={$ip}: [{$status}] {$method}@{$url}";

        Log::info($log);
    }
}
