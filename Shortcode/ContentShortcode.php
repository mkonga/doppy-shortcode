<?php

namespace Doppy\Shortcode\Shortcode;

class ContentShortcode extends AbstractShortcode
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $name
     * @param array  $parameters
     * @param int    $offset
     * @param string $originalText
     * @param string $content
     */
    public function __construct($name, array $parameters, $offset, $originalText, $content)
    {
        parent::__construct($name, $parameters, $offset, $originalText);
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}