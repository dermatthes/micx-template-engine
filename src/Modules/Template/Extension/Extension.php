<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/28/18
 * Time: 8:07 PM
 */

namespace Micx\Modules\Template\Extension;


use Micx\Modules\Template\Element\TemplateNode;
use Micx\Modules\Template\MicxTeimplateParserCallback;
use Micx\Modules\Template\MicxTemplate;

interface Extension
{

    public function buildNode (TemplateNode $node, MicxTemplate $currentTemplate);

}