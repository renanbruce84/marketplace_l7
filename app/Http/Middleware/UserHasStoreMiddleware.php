<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
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
        $user = \App\User::find(auth()->user()->id);
        // $user = auth()->user()->store()->count();
        if ($user->store()->count()) {
            flash('Você já possui uma loja')->warning();
            return redirect()->route('admin.stores.index');
        }        

        return $next($request);
    }
}
