<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboardingCompleted
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && ! $request->user()->onboarding_completo) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}