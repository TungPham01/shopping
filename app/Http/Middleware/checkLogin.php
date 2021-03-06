<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user(); // lấy ra ng dùng đang đăng nhập
            if($user){
                return $next($request);
            }else{
                return route('admin.login');
            }
        }else{
            return redirect('admin');
        }
    }
}
