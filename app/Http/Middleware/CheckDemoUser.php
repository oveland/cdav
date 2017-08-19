<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckDemoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::guest()) {
            return redirect(route('home'));
        }

        $demoTo = \Auth::user()->demo_to;
        $days = Carbon::today()->diffInDays($demoTo,false);

        if ($days > 0) {
            $message = flash("<i class='fa fa-exclamation-circle'></i>  Demo disponible por " . $days . " días");
            if ($days <= 1) {
                $message->error();
            } else if ($days < 3) {
                $message->warning();
            } else {
                $message->success();
            }
            $message->important();
        }else{
            flash("Su prueba demo caducadó ".(($days == 0)?" hoy":"hace ".abs($days)." días :("))->error();
            \Auth::logout();
            return redirect(route('home'));
        }

        return $next($request);
    }
}
