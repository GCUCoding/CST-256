<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class SecurityMiddleWare
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
        //get path
        $path = $request->path();
        Log::info("We are entering security Middleware. The path is" . $path);
        //Run the business rules that check for the uri, so no need to secure
        $secureCheck = (null == session('role'));
        
        //all the views that we want to make sure anyone can get to
        if($request->is('/')||$request->is('login')||
            $request->is('registration')||$request->is('home')||$request->is('islogin')||$request->is('logged')||$request->is('islogged')||$request->is('registered')
            ||$request->is('isregister')||$request->is('registration')||$request->is('register'))
             $secureCheck = false;
            
        Log::info($secureCheck ? "SecurityMiddleware in handle()...needs security" :
            "Security Middleware in handle()...No security Required");
        
        //If entering a secure URI with no security token, then do a redirect to root
        Log::info("This is the role in middleware: " . session()->get('role'));
        
        if(session()->get('role') == 'enabled')
            return $next($request);
        
        if($secureCheck)
        {
            Log:info("We are leaving the security Middleware in handle(). doing redircet back to login");
            return redirect('/login');
        }
            
        
        return $next($request);
    }
}
