<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 3:54 PM
 */

namespace Micx\Modules\Template\Element;


use HtmlTheme\Elements\DocumentNode;

class TemplateDocument extends DocumentNode implements TemplateNode
{
    use TemplateTrait;
}