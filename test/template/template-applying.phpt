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
use Micx\Modules\Template\TemplateFactory;
use Tester\Assert;

require __DIR__ . "/../bootstrap.php";



$tf = new TemplateFactory();
$vfs = VirtualFileSystem::Build(__DIR__ . "/mock");

$tpl = $tf->buildTemplate($vfs->withFileName("/basic.html"));

//print_r ($tpl);

$result = $tpl->apply([], null);

print_r ($result);
//Assert::true(true);