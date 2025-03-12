<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate([
            'id_pelanggan' => 'required|string',
            'id_barang' => 'required|string',
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ]);
        return $next($request);
    }
}
