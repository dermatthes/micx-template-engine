<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:07 PM
 */

namespace Micx\Modules\Template\Extension;


use Micx\Modules\Template\Element\TemplateNode;

interface Extension
{

    public function buildNode (TemplateNode $node);

}