<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class PaymentVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = $request->route('id_pesanan');
        $payment = DB::table('pembayaran')->where('id_pesanan', $orderId)->first();
        
        if (!$payment || $payment->status_pembayaran !== 'Paid') {
            return response()->json(['message' => 'Payment required before proceeding'], 403);
        }
        return $next($request);
    }
}
