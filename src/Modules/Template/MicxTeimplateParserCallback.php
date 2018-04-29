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
use Micx\Modules\Template\Element\TemplateContainerElement;
use Micx\Modules\Template\Element\TemplateDocument;
use Micx\Modules\Template\Element\TemplateElement;
use Micx\Modules\Template\Element\TemplateText;
use Micx\Modules\Template\Extension\Extension;

class MicxTeimplateParserCallback implements HtmlCallback
{

    /**
     * @var Extension[]
     */
    private $extensions = [];

    private $document;
    /**
     * @var TemplateContainerElement
     */
    private $curElement;


    public function __construct()
    {

    }

    public function setTemplate (MicxTemplate $template)
    {
        $this->document = $template;
        $this->curElement = $this->document;
    }

    public function clear ()
    {
        $this->document = null;
        $this->curElement = null;
    }

    public function registerExtension (Extension $extension)
    {
        $this->extensions[] = $extension;
    }



    public function onWhitespace(string $ws, int $lineNo)
    {
        // TODO: Implement onWhitespace() method.
    }

    public function onTagOpen(string $name, array $attributes, $isEmpty, $ns = null, int $lineNo)
    {
        if ($isEmpty) {
            $newElem = new TemplateElement($ns === null ? $name : "$ns:$name", $attributes);
        } else {
            $newElem = new TemplateContainerElement($ns === null ? $name : "$ns:$name", $attributes);
        }

        foreach ($this->extensions as $curExtension) {
            $curExtension->buildNode($newElem);
        }

        $this->curElement->add($newElem);
        $this->curElement = $newElem;
    }

    public function onText(string $text, int $lineNo)
    {
        $this->curElement->add(new TemplateText($text));
    }

    public function onTagClose(string $name, $ns = null, int $lineNo)
    {
        $this->curElement = $this->curElement->getParent();
    }

    public function onProcessingInstruction(string $data, int $lineNo)
    {
        if ( ! $this->curElement instanceof TemplateDocument)
            throw new \InvalidArgumentException("Expeceted TemplateDocument at processing instructions: $data");
        $this->curElement->setProcessingInstruction($data);
    }

    public function onComment(string $data, int $lineNo)
    {
        // TODO: Implement onComment() method.
    }

    public function onEos()
    {
        $this->clear();
    }
}