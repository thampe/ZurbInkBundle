<?php
/**
 *  InkyTokenParser.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   InkyTokenParser.php
 *  @package    symfony-2.8
 *  @author     Thomas Hampe <thomas@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       16.04.16
 */ 


namespace Hampe\Bundle\ZurbInkBundle\Twig;


use Hampe\Inky\Inky;
use Twig_Error_Syntax;
use Twig_NodeInterface;
use Twig_Token;

class InkyTokenParser extends \Twig_TokenParser
{

    const TAG = 'inky';

    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     *
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideInkyEnd'), true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        return new InkyNode($body, $lineno, $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return self::TAG;
    }

    public function decideInkyEnd(\Twig_Token $token)
    {
        return $token->test('end'.self::TAG);
    }

}