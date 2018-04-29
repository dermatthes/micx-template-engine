<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 1:09 AM
 */

namespace Test;
use Micx\Core\Vfs\VirtualFile;
use Micx\Core\Vfs\VirtualFileSystem;
use Micx\Modules\Template\RenderEnvironment;
use Micx\Modules\Template\TemplateFactory;
use Tester\Assert;

require __DIR__ . "/../bootstrap.php";



$tf = new TemplateFactory();

$vfs = VirtualFileSystem::Build(__DIR__ . "/mock");

$tpl = $tf->buildTemplate($virtFile = $vfs->withFileName("/extends2.html"));

//print_r ($tpl);
$scope = [];
$environment = new RenderEnvironment($scope, $tf, $virtFile);
$result = $tpl->apply($environment, null);

echo $result->render();
//Assert::true(true);