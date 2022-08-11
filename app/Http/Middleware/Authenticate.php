<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson())
        {
            $url = $request->url();
            Log::info('current url: ' . $url);
            // Check if current route is in administrator area
            if ($request->is('administrator*'))
            {
                Log::info('Administrator Area');
                return route('admin.login');
            }
            else if($request->is('siswa*')){
                Log::info('Siswa Area');
                return route('siswa.login');
            }
        }
    }
}
