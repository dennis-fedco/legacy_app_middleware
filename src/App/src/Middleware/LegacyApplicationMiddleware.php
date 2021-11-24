<?php
declare(strict_types = 1);
namespace App\Middleware;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class LegacyApplicationMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        // return $handler->handle($request);
        try
        {
            ob_start();
            $path = $request->getUri()->getPath();
            $path = substr($path, 1);

            // echo $path . '<br>';
            // if (file_exists($path)) echo "YES"; else echo "NO";

            $params = $request->getQueryParams();

            extract($params);

            include $path;

            $output = ob_get_contents();
            ob_end_clean();
            return new HtmlResponse($output);
        }
        catch (Throwable $exception)
        {
            return $handler->handle($request);
        }
    }
}
