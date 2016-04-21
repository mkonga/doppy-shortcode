<?php

namespace Doppy\Shortcode\HandledShortcode;

use Doppy\Shortcode\Shortcode\ShortcodeInterface;

class HandledShortcode implements HandledShortcodeInterface
{
    /**
     * @var ShortcodeInterface
     */
    protected $shortcode;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $suffix;

    /**
     * @var bool
     */
    protected $parseContent;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param ShortcodeInterface $shortcode
     * @param string             $prefix
     * @param string             $suffix
     * @param bool               $parseContent
     */
    public function __construct(ShortcodeInterface $shortcode, $prefix, $suffix, $parseContent = true)
    {
        $this->shortcode    = $shortcode;
        $this->prefix       = $prefix;
        $this->suffix       = $suffix;
        $this->parseContent = $parseContent;
    }

    public function getShortcode()
    {
        return $this->shortcode;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getContent()
    {
        if (!empty($this->content)) {
            return $this->content;
        } else {
            return $this->shortcode->getContent();
        }
    }

    public function overwriteContent($content)
    {
        $this->content = $content;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function parseContent()
    {
        return (($this->parseContent) && (mb_strlen($this->getContent(), 'utf-8') > 0));
    }
}