<?php

namespace App\Middlewares;

use App\Base\SqlQueryBuilder;

class SelectMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $entity = (explode('/',  $request->getUri()->getPath()))[1];

        $query = SqlQueryBuilder::select($entity);

        $request = $request->withAttribute('query', $query);
        $request = $request->withAttribute('entity', $entity);
        $response = $next($request, $response);

        return $response;
    }

}
