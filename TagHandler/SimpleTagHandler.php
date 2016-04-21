<?php

namespace Doppy\Shortcode\TagHandler;

use Doppy\Shortcode\HandledShortcode\HandledShortcode;
use Doppy\Shortcode\Shortcode\ShortcodeInterface;

class SimpleTagHandler extends AbstractTagHandler implements TagHandlerInterface
{
    /**
     * @var string
     */
    protected $htmlElement;

    /**
     * SimpleTagHandler constructor.
     *
     * @param string $tagName
     * @param string $htmlElement
     */
    public function __construct($tagName, $htmlElement)
    {
        parent::__construct($tagName);
        $this->htmlElement = $htmlElement;
    }

    public function handle(ShortcodeInterface $shortcode)
    {
        return new HandledShortcode(
            $shortcode,
            '<' . $this->htmlElement . '>',
            '</' . $this->htmlElement . '>',
            true
        );
    }
}