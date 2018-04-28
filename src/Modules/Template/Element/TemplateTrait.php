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
use Micx\Modules\Template\Extension\CopyNodeExtension;

trait TemplateTrait
{

    private $applyCb = [];

    public function apply (array $scope, HtmlContainerElement $targetNode)
    {
        if (count ($this->applyCb) == 0) {
            CopyNodeExtension::CopyNode($this, $scope, $targetNode);
        } else {
            foreach ($this->applyCb as $cb) {
                if (!is_callable($cb))
                    throw new \InvalidArgumentException("Callback expected." . print_r($cb, true));
                if ($cb($this, $scope, $targetNode) === false)
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
        throw new \InvalidArgumentException("Cannot clone this type of node.");
    }


    public function addApplyCb(callable $cb)
    {
        $this->applyCb[] = $cb;
    }

    public function hasApplyCb() {
        return count($this->applyCb) === 0;
    }


}