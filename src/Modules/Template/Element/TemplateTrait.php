<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 6:05 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\HtmlContainerElement;
use HtmlTheme\Elements\HtmlElement;
use HtmlTheme\Elements\TextNode;
use Micx\Modules\Template\Extension\CopyNodeExtension;
use Micx\Modules\Template\RenderEnvironment;

trait TemplateTrait
{

    private $applyCb = [];

    public function apply (RenderEnvironment $renderEnvironment, HtmlElement $targetNode)
    {
        if (count ($this->applyCb) == 0) {
            CopyNodeExtension::CopyNode($renderEnvironment, $this, $targetNode);
        } else {
            foreach ($this->applyCb as $cb) {
                if (!is_callable($cb))
                    throw new \InvalidArgumentException("Callback expected." . print_r($cb, true));
                if ($cb($renderEnvironment, $this, $targetNode) === false)
                    break;
            }
        }
    }


    public function clone ()
    {
        if ($this instanceof HtmlContainerElement) {
            return new HtmlContainerElement($this->tag, $this->attrs);
        }
        if ($this instanceof HtmlElement) {
            return new HtmlElement($this->tag, $this->attrs);
        }
        if ($this instanceof TemplateText) {
            return new TextNode($this->getText());
        }
        throw new \InvalidArgumentException("Cannot clone this type of node." . get_class($this));
    }


    public function addApplyCb(callable $cb)
    {
        $this->applyCb[] = $cb;
    }

    public function hasApplyCb() : bool
    {
        return count($this->applyCb) === 0;
    }


}