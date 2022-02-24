<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Partner;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class PartnerAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle(Request $request, Closure $next)
    {

        Config::set('database.connections.partner.database',"boss_".$request->account); 

        if ( Auth::guard("partner")->check() ) {
            
            if( $partner = \App\Models\Partner::select(["p_no","p_name"])->where('p_id', $request->account)->first() ) {
                $request->account_no = $partner->p_no;
                $request->account_name = $partner->p_name;
            }
            return $next($request);
        } else {

            Auth::guard("partner")->logout();
            return redirect('/partnerlogin');
            
        }


    }
}