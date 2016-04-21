<?php

namespace Doppy\Shortcode\TagHandlerContainer;

use Doppy\Shortcode\TagHandler\TagHandlerInterface;

class TagHandlerContainer implements TagHandlerContainerInterface
{
    /**
     * @var TagHandlerInterface[]
     */
    protected $handlers;

    public function get($tagName)
    {
        if ($this->has($tagName)) {
            return $this->handlers[$tagName];
        }
        return null;
    }

    public function has($tagName)
    {
        return array_key_exists($tagName, $this->handlers);
    }

    /**
     * @param TagHandlerInterface $handler
     */
    public function addHandler(TagHandlerInterface $handler)
    {
        $this->handlers[$handler->getTagName()] = $handler;
    }
}