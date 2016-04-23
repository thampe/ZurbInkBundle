<?php
/**
 *  InkyExtension.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   InkyExtension.php
 *  @package    symfony-2.8
 *  @author     Thomas Hampe <thomas@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       16.04.16
 */ 


namespace Hampe\Bundle\ZurbInkBundle\Twig;


use Hampe\Inky\Inky;

class InkyExtension extends \Twig_Extension
{

    const NAME = 'zurb_ink.inky';

    /**
     * @var Inky
     */
    protected $inky;

    public function __construct(Inky $inky)
    {
        $this->inky = $inky;
    }

    public function getName()
    {
        return self::NAME;
    }

    public function getTokenParsers()
    {
        return array(
            new InkyTokenParser()
        );
    }

    public function parse($html)
    {
        return $this->inky->releaseTheKraken($html);
    }

}