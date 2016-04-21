<?php

namespace Doppy\Shortcode\Parser;

use Doppy\Shortcode\Shortcode\ShortcodeInterface;

interface ParserInterface
{
    /**
     * Parse single shortcode match into object
     *
     * @param string $text
     *
     * @return ShortcodeInterface[]
     */
    public function parse($text);
}
