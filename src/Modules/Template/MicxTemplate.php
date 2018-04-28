<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 11:12 PM
 */

namespace Micx\Modules\Template;


use HtmlTheme\Elements\DocumentNode;
use HtmlTheme\Elements\HtmlElement;
use Micx\Core\Vfs\VirtualFile;

class MicxTemplate extends DocumentNode
{

    protected $virtualFile;

    public function __construct(VirtualFile $virtualFile)
    {
        parent::__construct();
        $this->virtualFile = $virtualFile;
    }



    public function apply (array $scope, HtmlElement $targetNode=null)
    {
        if ($targetNode === null)
            $targetNode = new DocumentNode();


    }


}