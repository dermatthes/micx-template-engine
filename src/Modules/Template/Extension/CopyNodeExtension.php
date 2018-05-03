<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:34 PM
 */

namespace Micx\Modules\Template\Extension;


use HtmlTheme\Elements\HtmlContainerElement;
use Micx\Modules\Template\Element\TemplateContainerElement;
use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\MicxTemplate;
use Micx\Modules\Template\RenderEnvironment;

class CopyNodeExtension implements Extension
{

    public function buildNode(TemplateNode $node, MicxTemplate $ownerTemplate)
    {
        // TODO: Implement buildNode() method.
    }


    public static function CopyNode(RenderEnvironment $renderEnvironment, TemplateNode $templateNode, HtmlContainerElement $targetNode)
    {
        $targetNode->add($curTarget = $templateNode->clone());
        if ($templateNode instanceof TemplateContainerElement) {
            foreach ($templateNode->getChildren() as $child)
                $child->apply($renderEnvironment, $curTarget);
        }

    }

}