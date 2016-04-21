<?php

namespace Doppy\Shortcode\TagHandler;

use Doppy\Shortcode\Shortcode\ShortcodeInterface;

abstract class AbstractTagHandler implements TagHandlerInterface
{
    /**
     * @var string
     */
    protected $tagName;

    /**
     * @param string $tagName
     */
    public function __construct($tagName)
    {
        $this->tagName = $tagName;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function canHandle(ShortcodeInterface $shortcode, ShortcodeInterface $parentShortcode = null)
    {
        // assume always true; if you have a case where it should not handle the shortcode, override this method.
        return true;
    }
} 