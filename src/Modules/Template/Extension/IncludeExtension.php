<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/3/18
 * Time: 11:51 PM
 */

namespace Micx\Modules\Template\Extension;


use HtmlTheme\Elements\HtmlContainerElement;
use Micx\Modules\Template\Element\TemplateContainerElement;
use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\MicxTemplate;
use Micx\Modules\Template\RenderEnvironment;

class IncludeExtension implements Extension
{

    public static function RunInclude (RenderEnvironment $renderEnvironment, TemplateNode $node, HtmlContainerElement $target)
    {
        $extendedVFS = $renderEnvironment->virtualFile->withPath()->withFileName($node->getMeta("include-tpl"));


        $includeEnvironemt = new RenderEnvironment($renderEnvironment->scope, $renderEnvironment->templateFactory, $extendedVFS);
        $includeEnvironemt->scope = array_merge($includeEnvironemt->scope, []);

        $includeTemplate = $renderEnvironment->templateFactory->buildTemplate($extendedVFS);
        $includeTemplate->apply($includeEnvironemt, $target);
    }


    public function buildNode(TemplateNode $node, MicxTemplate $ownerTemplate)
    {
        if ( ! $node instanceof TemplateContainerElement) {
            return;
        }
        if ($node->getTag() == "include") {
            $node->addApplyCb([IncludeExtension::class, "RunInclude"]);
            $node->setMeta("include-tpl", $node->getAttrib("name"));
            return;
        }
    }
}