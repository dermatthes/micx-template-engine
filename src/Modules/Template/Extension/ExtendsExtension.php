<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:15 PM
 */

namespace Micx\Modules\Template\Extension;


use HtmlTheme\Elements\HtmlContainerElement;
use Micx\Modules\Template\Element\TemplateElement;
use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\RenderEnvironment;

class ExtendsExtension implements Extension
{


    public static function RunExtends(RenderEnvironment $renderEnvironment, TemplateNode $node, HtmlContainerElement $target)
    {
        $renderEnvironment->
    }


    public function buildNode(TemplateNode $node)
    {
        if ( ! $node instanceof TemplateElement) {
            return;
        }
        if ($node->getTag() != "mx:extends") {
            return;
        }

        $node->addApplyCb([ExtendsExtension::class, "RunExtends"]);
    }
}