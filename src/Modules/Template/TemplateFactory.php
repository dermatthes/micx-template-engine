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
use Micx\Modules\Template\Extension\ExtendsExtension;

class TemplateFactory
{

    private $templateParserCallback;

    public function __construct()
    {
        $this->templateParserCallback = $tpc = new MicxTeimplateParserCallback();
        $tpc->registerExtension(new ExtendsExtension());
    }




    public function buildTemplate (VirtualFile $file) : MicxTemplate
    {
        $template = new MicxTemplate($file);
        $reader = new HTMLReader();
        $reader->setHandler($this->templateParserCallback);
        $this->templateParserCallback->setTemplate($template);
        //$parser->registerExtension();
        $reader->loadHtmlString($file->getContents());
        $reader->parse();
        return $template;
    }

}