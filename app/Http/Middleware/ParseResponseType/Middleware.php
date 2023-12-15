<?php

namespace App\Http\Middleware\ParseResponseType;

use App\Presenters\XmlPresenter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Middleware
{
    /**
     * Transforma o tipo da resposta com base no header da requisição
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $content = match ($request->header('Accept')) {
            AcceptableResponseTypes::XML->value => XmlPresenter::toXml($response->getOriginalContent()),
            AcceptableResponseTypes::TEXT->value => $response->content(),
            AcceptableResponseTypes::JSON->value => $response->content(),
            default => $response->content()
        };

        return $response->setContent($content);
    }
}
