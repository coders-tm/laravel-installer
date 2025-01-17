<?php

namespace Coderstm\LaravelInstaller\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureInstalled
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->installed()) {
            if ($request->is('install*')) {
                return $next($request);
            }
            return redirect('/install');
        }

        return $next($request);
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function installed()
    {
        return file_exists(storage_path('.installed'));
    }
}
