public function handle(Request $request, Closure $next): Response
{
    if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
        return $next($request);
    }

    abort(403);
}