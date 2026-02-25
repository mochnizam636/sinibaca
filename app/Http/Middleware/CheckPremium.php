<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chapter = $request->route('chapter');

        // Jika route tidak memiliki parameter chapter, lewati
        if (!$chapter) {
            return $next($request);
        }

        // Cek apakah chapter ATAU novelnya premium
        if ($chapter->is_premium || $chapter->novel->is_premium) {
            $user = $request->user();

            if (!$user || !$user->isPremium()) {
                return redirect()->route('subscription.index')->with('error', 'Konten ini khusus member Premium. Silakan berlangganan untuk melanjutkan membaca.');
            }
        }

        return $next($request);
    }
}
