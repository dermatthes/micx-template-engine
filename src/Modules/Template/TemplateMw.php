<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/30/18
 * Time: 1:41 AM
 */

namespace Micx\Modules\Template;


use Micx\Core\App\Application;
use Micx\Core\App\Mw\MiddleWare;
use Micx\Core\App\Mw\Next;
use Micx\Modules\Template\Config\T_TemplateConfig;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Stream;

class TemplateMw implements MiddleWare
{

    /**
     * @var T_TemplateConfig
     */
    protected $config;

    public function __construct(T_TemplateConfig $config)
    {
        $this->config = $config;
    }

    public function __invoke(ServerRequest $request, Response $response, Next $next, Application $app): Response
    {
        $file = $app->virtualFileSystem->withFileName($request->getUri()->getPath());
        if (! in_array($file->getExtension(), ["html", "md", "htm"])) {
            return $next($request, $response);
        }
        $contentType = $app->mimeMap->getMimeTypeByExtension($file->getExtension());
        $tpl = $app->templateFactory->buildTemplate($file);

        $scope = [];
        $environment = new RenderEnvironment($scope, $app->templateFactory, $file);
        $result = $tpl->apply($environment, null);

        return new Response\HtmlResponse($result->render(),200, ["Content-Type" => $contentType]);
    }
}