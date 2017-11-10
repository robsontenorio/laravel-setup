<?php namespace App\Http\Middleware;

class Cors
{
    public function handle($request, \Closure $next)
    {
        // 		$response = $next($request);
// 		$response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
// 		$response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
// 		$response->header('Access-Control-Allow-Origin', '*');
// 		$response->header('Access-Control-Expose-Headers', 'Authorization');
// 		$response->header('Access-Control-Request-Headers', 'Authorization');

// 		return $response;

        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-CSRF-TOKEN')
        ->header('Access-Control-Expose-Headers', 'Authorization')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
