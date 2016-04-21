<?php

namespace Doppy\Shortcode\TagHandlerContainer;

use Doppy\Shortcode\TagHandler\TagHandlerInterface;

interface TagHandlerContainerInterface
{
    /**
     * @param string $tagName
     *
     * @return TagHandlerInterface
     */
    public function get($tagName);

    /**
     * @param string $tagName
     *
     * @return bool
     */
    public function has($tagName);
}