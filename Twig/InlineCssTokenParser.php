<?php
/**
 * symfony
 * User: thomas
 * Date: 20.11.13
 * Time: 18:05
 */

namespace Hampe\Bundle\ZurbInkBundle\Twig;

use \Twig_Token;
use \Twig_TokenParser;

class InlineCssTokenParser extends Twig_TokenParser
{

    protected $fileLocator;

    protected $inlineStyles;

    public function __construct()
    {
    }

    public function parse(Twig_Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $html = $this->parser->subparse(array($this, 'decideEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new InlineCssNode($html, $token->getLine(), $this->getTag());

    }

    public function getTag()
    {
        return "inlinestyle";
    }

    public function decideEnd(Twig_Token $token)
    {
        return $token->test('endinlinestyle');
    }
}
