<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือยัง
        if (!Auth::check()) {
            // ถ้ายังไม่ได้ล็อกอิน ให้ redirect ไปหน้า login
            return redirect('/login')->with('error', 'กรุณาล็อกอินก่อน');
        }

        // ตรวจสอบว่า usertype เป็น admin หรือไม่
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->back()->with('error', 'ไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        return $next($request);
    }
}