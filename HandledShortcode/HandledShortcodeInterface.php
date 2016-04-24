<?php

namespace Doppy\Shortcode\HandledShortcode;

use Doppy\Shortcode\Shortcode\ShortcodeInterface;

interface HandledShortcodeInterface
{

    /**
     * @param ShortcodeInterface $shortcode
     * @param string             $prefix
     * @param string             $suffix
     * @param bool               $parseContent
     */
    public function __construct(ShortcodeInterface $shortcode, $prefix, $suffix, $parseContent = true);

    /**
     * @return ShortcodeInterface
     */
    public function getShortcode();

    /**
     * The content that needs to be in front of the content between the tags
     *
     * @return string
     */
    public function getPrefix();

    /**
     * The content that was between the original tags. Use `overwriteContent` to replace this if needed.
     *
     * @return null|string
     */
    public function getContent();

    /**
     * Overwrites the content of the original Shortcode with different content to use
     *
     * Use this when you want to change the content in your TagHandler.
     *
     * @param string|null $content
     */
    public function overwriteContent($content = null);

    /**
     * The content that needs to be after the content between the tags
     *
     * @return string
     */
    public function getSuffix();

    /**
     * Tells if the content should be parsed further (recursively). Make sure it returns false when your TagHandler already handled the actual content.
     *
     * @return bool
     */
    public function parseContent();

    /**
     * Configures wheter the content should be parsed or not
     *
     * @param bool $parseContent
     */
    public function setParseContent($parseContent);
}