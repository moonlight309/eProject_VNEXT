<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;

class CheckAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== UserRoleEnum::ADMIN) {
            return abort(404);
        }

        return $next($request);
    }
}
