<?php

namespace Takshak\Logging\Http\Middleware;

use Takshak\Logging\Traits\LoggingTrait;
use Closure;
use Illuminate\Http\Request;

class Logging
{
    use LoggingTrait;
    public function handle(Request $request, Closure $next, $driver='file')
    {
        $this->logActivity($driver);
        return $next($request);
    }
}
