<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Routing\Middleware;

class Language implements Middleware {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if ( ! array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $segments = $request->segments();
            $language = $this->app->config->get('app.fallback_locale');
            array_unshift($segments, $language);
            $newUrl = implode('/', $segments);
            if(array_key_exists('QUERY_STRING', $_SERVER))
                if($_SERVER['QUERY_STRING'])
                    $newUrl .= '?'.$_SERVER['QUERY_STRING'];
            return $this->redirector->to($newUrl);
        }

        $this->app->setLocale($locale);

        return $next($request);
    }

}