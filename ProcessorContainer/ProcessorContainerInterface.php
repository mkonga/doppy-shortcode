<?php

namespace Doppy\Shortcode\ProcessorContainer;

use Doppy\Shortcode\Exception\MissingProcessorException;
use Doppy\Shortcode\Processor\ProcessorInterface;

interface ProcessorContainerInterface
{
    /**
     * @param string $name
     *
     * @return null|ProcessorInterface
     * 
     * @throws MissingProcessorException
     */
    public function get($name = 'default');
}