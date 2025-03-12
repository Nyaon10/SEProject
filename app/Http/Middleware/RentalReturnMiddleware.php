<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RentalReturnMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = $request->route('id_pesanan');
        $order = DB::table('pesanan')->where('id_pesanan', $orderId)->first();
        
        if (!$order || $order->status_pesanan !== 'Completed') {
            return response()->json(['message' => 'You can only review completed orders'], 403);
        }
        return $next($request);
    }
}
