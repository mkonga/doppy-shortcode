<?php

namespace Doppy\Shortcode\ProcessorContainer;

use Doppy\Shortcode\Exception\MissingProcessorException;
use Doppy\Shortcode\Processor\ProcessorInterface;

class ProcessorContainer implements ProcessorContainerInterface
{
    /**
     * @var ProcessorInterface[]
     */
    protected $processors = [];

    /**
     * @param ProcessorInterface $processor
     * @param string             $alias
     */
    public function add(ProcessorInterface $processor, $alias)
    {
        $this->processors[$alias] = $processor;
    }

    /**
     * @param string $name
     *
     * @return null|ProcessorInterface
     */
    public function get($name = 'default')
    {
        if (array_key_exists($name, $this->processors)) {
            return $this->processors[$name];
        } else {
            throw new MissingProcessorException('Processor `' . $name . '` is not configured.');
        }
    }
}