<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderOwnershipMiddleware
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
        
        if (!$order || $order->id_pelanggan !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access to order'], 403);
        }
        return $next($request);
    }
}
