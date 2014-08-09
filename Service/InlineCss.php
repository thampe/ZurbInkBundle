<?php
/**
 *  InlineCss.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   InlineCss.php
 *  @package    zurb-ink-bundle-symfony
 *  @author     Thomas Hampe <thomas@hampe.co>
 *  @copyright  2013-2014 Thomas Hampe
 *  @date       09.08.14
 */ 

namespace Hampe\Bundle\ZurbInkBundle\Service;


use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class InlineCss
{

    /**
     * @var CssToInlineStyles
     */
    protected $cssToInlineStyles;

    public function setCss($css)
    {
        $this->getCssToInlineStyles()->setCSS($css);
    }

    public function setHtml($html)
    {
        $this->getCssToInlineStyles()->setHTML($html);
    }

    public function convert()
    {
        $html = $this->getCssToInlineStyles()->convert();
        // reset the whole InlineStyles Object (it does not reset the parsed css-rules after ::convert())
        $this->cssToInlineStyles = null;

        return $html;
    }

    /**
     *
     * @return CssToInlineStyles
     */
    protected function getCssToInlineStyles()
    {
        if(!$this->cssToInlineStyles) {
            $this->cssToInlineStyles = new CssToInlineStyles();
        }

        return $this->cssToInlineStyles;
    }


} 