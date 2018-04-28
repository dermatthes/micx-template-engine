<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:09 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\HtmlElement;

interface TemplateNode
{

    public function apply (array $scope, HtmlElement $element);
    public function addApplyCb(callable $cb);

    public function hasApplyCb() :bool ;
    public function clone();
}