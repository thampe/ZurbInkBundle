<?php
/**
 *  CssContainer.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   CssContainer.php
 *  @package    zurb-ink-bundle-symfony
 *  @author     Thomas Hampe <thomas@hampe.co>
 *  @copyright  2013-2014 Thomas Hampe
 *  @date       09.08.14
 */ 

namespace Hampe\Bundle\ZurbInkBundle\Service;


class CssContainer implements \IteratorAggregate{

    protected $cssFiles = array();

    public function add($file)
    {
        $this->cssFiles[] = $file;
    }

    public function removeAll()
    {
        $this->cssFiles = array();
    }

    public function getIterator() {
        return new \ArrayIterator($this->cssFiles);
    }

} 