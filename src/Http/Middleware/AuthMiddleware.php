<?php

namespace NixEnterprise\GrafanaDatasource\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AuthMiddleware
{
    const NAME = 'auth.web';

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getUser() != Config::get('grafana.grafana_user') ||
            $request->getPassword() != Config::get('grafana.grafana_pass')) {

            $headers = ['WWW-Authenticate' => 'Basic'];

            return response('Unauthorized', 401, $headers);
        }

        return $next($request);
    }
}
