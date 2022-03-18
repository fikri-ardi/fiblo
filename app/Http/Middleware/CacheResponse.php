<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    private $ttl;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $ttl = null)
    {
        $this->ttl = $ttl ?? now()->addMinutes(10);

        if (Cache::has($this->cacheKey($request))) {
            return response(Cache::get($this->cacheKey($request)));
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Cache::has($this->cacheKey($request))) {
            return;
        }
        Cache::put($this->cacheKey($request), $response->getContent(), $this->ttl);
    }

    private function cacheKey($request)
    {
        return md5($request->fullUrl() . '-' . auth()->id());
    }
}