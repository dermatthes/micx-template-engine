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



    protected function _parseMarkdown ($content)
    {

        if (preg_match("/^-{3,}\\n(.*?)\\n-{3,}(.*)/ims", $content, $matches)) {
            $meta = yaml_parse($matches[1]);
            $content = $matches[2];
            return [$meta, $content];
        }

        return [[], $content];
    }



    public function buildTemplate (VirtualFile $file) : MicxTemplate
    {
        return $file->getParsedCached(function () use ($file) {
            if ($file->getExtension() == "md") {
                if ( ! class_exists("\ParsedownExtra"))
                    throw new \InvalidArgumentException("Class ParsedownExtra not found. Is optional package erusev/parsedown-extra installed?");

                $file->getContents();

                $parser = new \ParsedownExtra();
                [$meta, $content] = $this->_parseMarkdown($file->getContents());
                $content = $parser->text($content);

                if (isset ($meta["extends"])) {
                    $content =  "<extends name=\"{$meta["extends"]}\">\n{$content}\n</extends>";
                }
            } else {
                $content = $file->getContents();
            }

            $template = new MicxTemplate($file);
            $reader = new HTMLReader();
            $reader->setHandler($this->templateParserCallback);
            $this->templateParserCallback->setTemplate($template);
            //$parser->registerExtension();
            $reader->loadHtmlString($content);
            $reader->parse();
            return $template;
        });

    }

}