<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/29/18
 * Time: 9:12 PM
 */

namespace Micx\Modules\Template;


use Micx\Core\Vfs\VirtualFile;

class RenderEnvironment
{




    /**
     * @var array
     */
    public $scope;

    /**
     * @var TemplateFactory
     */
    public $templateFactory;

    /**
     * @var VirtualFile
     */
    public $virtualFile;

    public $extends = null;
    public $slots = [];

    public function __construct(array &$scope, TemplateFactory $templateFactory, VirtualFile $virtualFile)
    {
        $this->scope =& $scope;
        $this->templateFactory = $templateFactory;
        $this->virtualFile = $virtualFile;
    }
}