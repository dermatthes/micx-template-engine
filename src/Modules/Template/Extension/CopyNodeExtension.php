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

class CopyNodeExtension implements Extension
{

    public function buildNode(TemplateNode $node)
    {
        // TODO: Implement buildNode() method.
    }


    public static function CopyNode(TemplateNode $templateNode, array $scope, HtmlContainerElement $targetNode)
    {
        $targetNode->add($templateNode->clone());

    }

}