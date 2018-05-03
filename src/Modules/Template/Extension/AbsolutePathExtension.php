<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/4/18
 * Time: 12:44 AM
 */

namespace Micx\Modules\Template\Extension;


use HtmlTheme\Elements\DocumentNode;
use HtmlTheme\Elements\HtmlContainerElement;
use Micx\Modules\Template\Element\TemplateContainerElement;
use Micx\Modules\Template\Element\TemplateElement;
use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\MicxTemplate;
use Micx\Modules\Template\RenderEnvironment;

class AbsolutePathExtension implements Extension
{

    public function buildNode(TemplateNode $node, MicxTemplate $ownerTemplate)
    {
        /*if ( ! $node instanceof DocumentNode) {
            return;
        }*/

        foreach (["href", "src"] as $attr) {
            if ($node->getAttrib($attr) === null)
                continue;
            $node->setAttrib($attr, $ownerTemplate->getVirtualFile()->withPath("")->getAbsWwwRoot() . "/" . $node->getAttrib($attr));
        }
    }
}