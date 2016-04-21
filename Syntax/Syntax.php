<?php

namespace Doppy\Shortcode\Syntax;

class Syntax implements SyntaxInterface
{
    /**
     * @var string
     */
    protected $openingTag;

    /**
     * @var string
     */
    protected $closingTag;

    /**
     * @var string
     */
    protected $closingTagMarker;

    /**
     * @var string
     */
    protected $parameterValueSeparator;

    /**
     * @var string
     */
    protected $parameterValueDelimiter;

    /**
     * Syntax constructor.
     *
     * @param string $openingTag
     * @param string $closingTag
     * @param string $closingTagMarker
     * @param string $parameterValueSeparator
     * @param string $parameterValueDelimiter
     */
    public function __construct(
        $openingTag = '[',
        $closingTag = ']',
        $closingTagMarker = '/',
        $parameterValueSeparator = '=',
        $parameterValueDelimiter = '"'
    )
    {
        $this->openingTag              = $openingTag;
        $this->closingTag              = $closingTag;
        $this->closingTagMarker        = $closingTagMarker;
        $this->parameterValueSeparator = $parameterValueSeparator;
        $this->parameterValueDelimiter = $parameterValueDelimiter;
    }

    public function getOpeningTag()
    {
        return $this->openingTag ?: '[';
    }

    public function getClosingTag()
    {
        return $this->closingTag ?: ']';
    }

    public function getClosingTagMarker()
    {
        return $this->closingTagMarker ?: '/';
    }

    public function getParameterValueSeparator()
    {
        return $this->parameterValueSeparator ?: '=';
    }

    public function getParameterValueDelimiter()
    {
        return $this->parameterValueDelimiter ?: '"';
    }
}
