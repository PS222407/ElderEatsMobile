<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use View;

class GlobalVariables
{
    public function handle(Request $request, Closure $next): Response
    {
        $accounts = auth()->user()?->connectedAccounts->pluck('id');
        View::share('linkedAccounts', $accounts);

        return $next($request);
    }
}
