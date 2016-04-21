<?php

namespace Doppy\Shortcode\TagHandler;

use Doppy\Shortcode\HandledShortcode\HandledShortcodeInterface;
use Doppy\Shortcode\Shortcode\ShortcodeInterface;

interface TagHandlerInterface
{
    /**
     * @return string
     */
    public function getTagName();

    /**
     * @param ShortcodeInterface $shortcode
     *
     * @return HandledShortcodeInterface
     */
    public function handle(ShortcodeInterface $shortcode);

    /**
     * Tells if the handler is willing to handle the given shortcode
     * 
     * The handler may decide it will not handle the given Shortcode because of the given parent shortcode.
     * 
     * @param ShortcodeInterface $shortcode       
     * @param ShortcodeInterface $parentShortcode The direct parent shortcode of the given shortcode
     *
     * @return bool
     */
    public function canHandle(ShortcodeInterface $shortcode, ShortcodeInterface $parentShortcode = null);
}