<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

        // 認証されたユーザーを特定のページにリダイレクトするためのミドルウェア
        // ログインや登録のページにアクセスする際に、すでにログインしているユーザーが再度アクセスできないようにする役割を果たす

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            // もし管理者としてログイン状態なら、トップ画面へリダイレクトする
            if($guard == "admin" && Auth::guard($guard)->check()){
                return redirect('/admin/top');
            }

        }
        // ログインしていなかったら、そのままリクエストを処理する
        return $next($request);
    }
}
