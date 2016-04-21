<?php

namespace Doppy\Shortcode\Shortcode;

class InvalidShortcode extends AbstractShortcode
{
    public function needsReplacing()
    {
        return false;
    }
}