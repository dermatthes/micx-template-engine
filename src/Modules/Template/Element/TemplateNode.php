<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:09 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\HtmlContainerElement;
use HtmlTheme\Elements\HtmlElement;
use HtmlTheme\Elements\HtmlElementNode;
use Micx\Modules\Template\RenderEnvironment;

interface TemplateNode
{

    public function apply (RenderEnvironment $environment, HtmlElement $targetNode);
    public function addApplyCb(callable $cb);

    public function hasApplyCb() :bool ;

    public function setMeta($name, $value);
    public function getMeta($name);


    /**
     * @return HtmlContainerElement
     */
    public function clone();
}