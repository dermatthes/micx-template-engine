<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 3:37 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\TextNode;

class TemplateText extends TextNode implements TemplateNode
{
    use TemplateTrait;
}