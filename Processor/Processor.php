<?php

namespace Doppy\Shortcode\Processor;

use Doppy\Shortcode\HandledShortcode\HandledShortcodeInterface;
use Doppy\Shortcode\TagHandlerContainer\TagHandlerContainerInterface;
use Doppy\Shortcode\Parser\ParserInterface;
use Doppy\Shortcode\Shortcode\ShortcodeInterface;

class Processor implements ProcessorInterface
{
    /**
     * @var int
     */
    protected $maxDepth;

    /**
     * @var string[]
     */
    protected $handlers;

    /**
     * @var string
     */
    protected $fallbackHandler;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @var TagHandlerContainerInterface
     */
    protected $tagHandlerContainer;

    /**
     * @param array                        $config
     * @param ParserInterface              $parser
     * @param TagHandlerContainerInterface $tagHandlerContainer
     */
    public function __construct($config, ParserInterface $parser, TagHandlerContainerInterface $tagHandlerContainer)
    {
        $this->maxDepth            = $config['max_depth'];
        $this->handlers            = $config['handlers'];
        $this->fallbackHandler     = $config['fallback_handler'];
        $this->parser              = $parser;
        $this->tagHandlerContainer = $tagHandlerContainer;
    }

    public function parse($text)
    {
        return $this->parseRecursive($text);
    }

    /**
     * @param string                  $text
     * @param ShortcodeInterface|null $parentShortcode
     * @param int                     $depth
     *
     * @return string
     */
    protected function parseRecursive($text, ShortcodeInterface $parentShortcode = null, $depth = 1)
    {
        // do nothing when max-depth is reached
        if ($depth > $this->maxDepth) {
            return $text;
        }

        // parse this bit of text
        $shortcodes = $this->parser->parse($text);

        // handle each shortcode
        foreach (array_reverse($shortcodes) as $shortcode) {
            $text = $this->handleShortcode($text, $shortcode, $parentShortcode, $depth);
        }

        // return resulting text
        return $text;
    }

    /**
     * Handles a single shortcode and replaces the content
     *
     * @param string             $text
     * @param ShortcodeInterface $shortcode
     * @param ShortcodeInterface $parentShortcode
     * @param int                $depth
     *
     * @return string
     */
    protected function handleShortcode($text, $shortcode, $parentShortcode, $depth)
    {
        /** @var ShortcodeInterface $shortcode */
        // get handler for this shortcode
        $handler = $this->getTagHandler($shortcode->getName());
        if (empty($handler)) {
            return $text;
        }

        // check if the handler is willing to handle this shortcode
        if (!$handler->canHandle($shortcode, $parentShortcode)) {
            return $text;
        }

        // parse this one
        $handledShortcode = $handler->handle($shortcode);

        // maybe parse content of what was parsed here?
        $content = $handledShortcode->getContent();
        if ($handledShortcode->parseContent()) {
            $content = $this->parseRecursive($content, $shortcode, $depth + 1);
        }

        // now replace
        return $this->replaceText($text, $handledShortcode, $content);
    }

    /**
     * @param string $name
     *
     * @return \Doppy\Shortcode\TagHandler\TagHandlerInterface|null
     */
    protected function getTagHandler($name)
    {
        if (in_array($name, $this->handlers)) {
            return $this->tagHandlerContainer->get($name);
        }
        return $this->tagHandlerContainer->get($this->fallbackHandler);
    }

    /**
     * @param string                    $text
     * @param HandledShortcodeInterface $handledShortcode
     * @param string                    $newContent
     *
     * @return string
     */
    protected function replaceText($text, $handledShortcode, $newContent)
    {
        // anything before the shortcode
        $returnText = mb_substr($text, 0, $handledShortcode->getShortcode()->getOffset(), 'utf-8');

        // what was replaced
        $returnText .= $handledShortcode->getPrefix();
        $returnText .= $newContent;
        $returnText .= $handledShortcode->getSuffix();

        // anything after the shortcode
        $returnText .= mb_substr(
            $text,
            $handledShortcode->getShortcode()->getOffset() + $handledShortcode->getShortcode()->getLength(),
            null,
            'utf-8'
        );

        // return that
        return $returnText;
    }
}
