<?php
/**
 * symfony
 * User: thomas
 * Date: 20.11.13
 * Time: 17:59
 */

namespace Hampe\Bundle\ZurbInkBundle\Twig;

use Hampe\Bundle\ZurbInkBundle\Service\CssContainer;
use \Twig_Extension;
use \Twig_Extension_GlobalsInterface;
use \Twig_SimpleFunction;
use \PhpCollection\Sequence;

class InlineCssExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{

    protected $inlineCss;

    protected $fileLocator;


    public function __construct($inlineCss, $fileLocator)
    {
        $this->inlineCss = $inlineCss;
        $this->fileLocator = $fileLocator;
    }

    public function getName()
    {
        return "zurb_ink.inlinecss";
    }

    public function getGlobals()
    {
        return array(
            "zurb_ink_inlinecss" => $this->inlineCss,
            "zurb_ink_locator" => $this->fileLocator,
            "zurb_ink_styles" => new CssContainer()
        );

    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('includeStyles', array($this, 'includeStyles'))
        );
    }

    public function getTokenParsers()
    {
        return array(
            new InlineCssTokenParser()
        );
    }

    public function includeStyles ($styles)
    {
        $locator = $this->fileLocator;
        $style = "";
        foreach ($styles as $styleFile) {
            $path = $locator->locate($styleFile);
            $style .= "\n\n".file_get_contents($path);
        }

        return $style;
    }
}
