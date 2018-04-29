<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:15 PM
 */

namespace Micx\Modules\Template\Extension;


use HtmlTheme\Elements\DocumentNode;
use HtmlTheme\Elements\HtmlContainerElement;
use Micx\Modules\Template\Element\TemplateContainerElement;
use Micx\Modules\Template\Element\TemplateElement;
use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\RenderEnvironment;

class ExtendsExtension implements Extension
{


    /**
     * @param RenderEnvironment $renderEnvironment
     * @param TemplateNode $node
     * @param HtmlContainerElement $target
     * @throws \Micx\Core\Vfs\PathNotFoundException
     * @throws \Micx\Core\Vfs\PathOutOfBoundsException
     */
    public static function RunExtends(RenderEnvironment $renderEnvironment, TemplateNode $node, HtmlContainerElement $target)
    {

        $delayedDocument = new DocumentNode();
        if ($node instanceof HtmlContainerElement) {
            foreach ($node->getChildren() as $child)
                $child->apply($renderEnvironment, $delayedDocument);
        }

        $renderEnvironment->scope["content"] = $delayedDocument;



        $extendedVFS = $renderEnvironment->virtualFile->withPath()->withFileName($node->getMeta("extends-tpl"));
        $extendedEnvironment = new RenderEnvironment($renderEnvironment->scope, $renderEnvironment->templateFactory, $extendedVFS);
        $extendedEnvironment->scope["wurst"]= "muh";
        $extendedTemplate = $renderEnvironment->templateFactory->buildTemplate($extendedVFS);
        $extendedDocument = new DocumentNode();

        $extendedTemplate->apply($extendedEnvironment, $extendedDocument);

        $target->add($extendedDocument);
    }

    public static function RunWith (RenderEnvironment $renderEnvironment, TemplateNode $node, HtmlContainerElement $target)
    {

    }

    public static function RunSlot (RenderEnvironment $renderEnvironment, TemplateNode $node, HtmlContainerElement $target)
    {
        $slotName = $node->getMeta("slot-name");
        if ($slotName === null)
            $slotName = "default";
        if ( ! isset ($renderEnvironment->scope[$slotName])) {
            if (! $node instanceof TemplateContainerElement)
                throw new \InvalidArgumentException("Slot is only applicable on container node (1)");
            foreach ($node->getChildren() as $child)
                $child->apply($renderEnvironment, $target);
        } else {

            if ( ! $target instanceof HtmlContainerElement)
                throw new \InvalidArgumentException("Slot is only applicable on container node (2)");

            $content = $renderEnvironment->scope[$slotName];
            if (is_array($content)) {
                foreach ($content as $curContent)
                    $target->add($curContent);
            } else {
                $target->add($content);
            }
        }
    }

    public function buildNode(TemplateNode $node)
    {
        if ( ! $node instanceof TemplateContainerElement) {
            return;
        }
        if ($node->getTag() == "extends") {
            $node->addApplyCb([ExtendsExtension::class, "RunExtends"]);
            $node->setMeta("extends-tpl", $node->getAttrib("name"));
            return;
        }
        if ($node->getTag() == "with") {
            $node->addApplyCb([ExtendsExtension::class, "RunWith"]);
            return;
        }
        if ($node->getTag() == "slot") {
            $node->addApplyCb([ExtendsExtension::class, "RunSlot"]);
            $node->setMeta("slot-name", $node->getAttrib("name"));
            return;
        }

    }
}