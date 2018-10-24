<?php declare(strict_types=1);

namespace App;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader as DiYamlLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader as RouterYamlLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Kernel
{
    public function handle(Request $request): Response
    {
        try {
            $context = new RequestContext();
            $context->fromRequest($request);

            $diContainer = $this->initDiContainer();
            $matcher = new UrlMatcher($this->getRoutes(), $context);
            $parameters = $matcher->match($context->getPathInfo());

            $controllerChunks = explode('::', $parameters['_controller']);
            $controller = $diContainer->get($controllerChunks[0]);
            $action = $controllerChunks[1];

            $response = \call_user_func_array([$controller, $action], $parameters);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response = new Response(
                sprintf("System error: %s\n<pre>%s</pre>", $e->getMessage(), $e->getTraceAsString()),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $response;
    }

    protected function getRoutes(): RouteCollection
    {
        $loader = new RouterYamlLoader($this->getConfigDir());

        return $loader->load('routes.yml');
    }

    protected function initDiContainer(): ContainerBuilder
    {
        $containerBuilder = new ContainerBuilder;
        $loader = new DiYamlLoader($containerBuilder, $this->getConfigDir());
        $loader->load('di.yml');
        $containerBuilder->compile();

        return $containerBuilder;
    }

    protected function getConfigDir(): FileLocator
    {
        return new FileLocator(\dirname(__FILE__, 2) . '/config/');
    }
}
