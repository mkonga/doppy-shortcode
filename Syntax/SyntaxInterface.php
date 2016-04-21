<?php

namespace Doppy\Shortcode\Syntax;

interface SyntaxInterface
{
    /**
     * @return string
     */
    public function getOpeningTag();

    /**
     * @return string
     */
    public function getClosingTag();

    /**
     * @return string
     */
    public function getClosingTagMarker();

    /**
     * @return string
     */
    public function getParameterValueSeparator();

    /**
     * @return string
     */
    public function getParameterValueDelimiter();
}
