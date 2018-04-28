<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 3:35 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\HtmlElement;

class TemplateElement extends HtmlElement implements TemplateNode
{
    use TemplateTrait;
}