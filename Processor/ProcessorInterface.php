<?php

Namespace Doppy\Shortcode\Processor;

interface ProcessorInterface
{
    /**
     * Parse the passed string and replace the tags with other content
     *
     * @param string $text
     *
     * @return string
     */
    public function parse($text);
}