<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/27/18
 * Time: 11:57 PM
 */

namespace Micx\Modules\Template;


use HTML5\Tokenizer\HtmlCallback;
use HtmlTheme\Elements\DocumentNode;
use HtmlTheme\Elements\HtmlContainerElement;
use HtmlTheme\Elements\HtmlElement;
use HtmlTheme\Elements\TextNode;

class MicxTeimplateParserCallback implements HtmlCallback
{

    private $document;
    private $curElement;


    public function __construct(MicxTemplate $template)
    {
        $this->document = $template;
        $this->curElement = $this->document;

    }


    public function onWhitespace(string $ws, int $lineNo)
    {
        // TODO: Implement onWhitespace() method.
    }

    public function onTagOpen(string $name, array $attributes, $isEmpty, $ns = null, int $lineNo)
    {
        if ($isEmpty) {
            $this->curElement->add(new HtmlElement($name, $attributes));
            return;
        }
        $this->curElement->add($new = new HtmlContainerElement($name, $attributes));
        $this->curElement = $new;
    }

    public function onText(string $text, int $lineNo)
    {
        $this->curElement->add(new TextNode($text));
    }

    public function onTagClose(string $name, $ns = null, int $lineNo)
    {
        $this->curElement = $this->curElement->getParent();
    }

    public function onProcessingInstruction(string $data, int $lineNo)
    {
        // TODO: Implement onProcessingInstruction() method.
    }

    public function onComment(string $data, int $lineNo)
    {
        // TODO: Implement onComment() method.
    }

    public function onEos()
    {
        // TODO: Implement onEos() method.
    }
}