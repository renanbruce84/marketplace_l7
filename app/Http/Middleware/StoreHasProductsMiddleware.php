<?php

namespace App\Http\Middleware;

use Closure;

class StoreHasProductsMiddleware
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

        if (!$user->store()->count()) {
            flash('Por favor crie uma loja')->warning();
            return redirect()->route('admin.stores.index');
        }

        return $next($request);
    }
}
