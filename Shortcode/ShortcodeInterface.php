<?php

namespace Doppy\Shortcode\Shortcode;

interface ShortcodeInterface
{
    /**
     * Returns shortcode name
     *
     * @return string
     */
    public function getName();

    /**
     * Tells if the shortcode should (still) be replaced or not
     *
     * @return bool
     */
    public function needsReplacing();

    /**
     * Returns associative array(name => value) of shortcode parameters
     *
     * @return array
     */
    public function getParameters();

    /**
     * Returns parameter value using its name, will return null for parameter
     * without value
     *
     * @param string $name    Parameter name
     * @param null   $default Value returned if there is no parameter with given name
     *
     * @return mixed
     */
    public function getParameter($name, $default = null);

    /**
     * Tells if a certain parameter is available
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasParameter($name);

    /**
     * Returns the staring position of the shortcode in the original text
     *
     * @return int
     */
    public function getOffset();

    /**
     * Returns the complete length of the original shortcode
     *
     * @return int
     */
    public function getLength();

    /**
     * Returns the complete original string
     *
     * @return string
     */
    public function getOriginalText();

    /**
     * Returns the content inside the shortcode
     *
     * @return string|null
     */
    public function getContent();
}
