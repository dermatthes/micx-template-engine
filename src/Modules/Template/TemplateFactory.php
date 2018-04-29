<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 10:36 PM
 */

namespace Micx\Modules\Template;


use HTML5\HTMLReader;
use Micx\Core\Vfs\VirtualFile;

class TemplateFactory
{

    public function buildTemplate (VirtualFile $file) : MicxTemplate
    {
        $template = new MicxTemplate($file);
        $reader = new HTMLReader();
        $reader->setHandler($parser = new MicxTeimplateParserCallback());
        $parser->setTemplate($template);
        //$parser->registerExtension();
        $reader->loadHtmlString($file->getContents());
        $reader->parse();
        return $template;
    }

}