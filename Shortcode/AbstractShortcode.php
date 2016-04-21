<?php

namespace Doppy\Shortcode\Shortcode;

abstract class AbstractShortcode implements ShortcodeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $parameters = array();

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var string
     */
    protected $originalText;

    /**
     * @param string $name
     * @param array  $parameters
     * @param int    $offset
     * @param string $originalText
     */
    public function __construct($name, array $parameters, $offset, $originalText)
    {
        $this->name         = $name;
        $this->parameters   = $parameters;
        $this->offset       = $offset;
        $this->originalText = $originalText;
    }

    public function getName()
    {
        return $this->name;
    }

    public function needsReplacing()
    {
        return true;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameter($name, $default = null)
    {
        if ($this->hasParameter($name)) {
            return $this->parameters[$name];
        } else {
            return $default;
        }
    }

    public function hasParameter($name)
    {
        return array_key_exists($name, $this->parameters);
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getLength()
    {
        return mb_strlen($this->getOriginalText(), 'utf-8');
    }

    public function getOriginalText()
    {
        return $this->originalText;
    }

    public function getContent()
    {
        return null;
    }
}
