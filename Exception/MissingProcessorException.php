<?php

namespace Doppy\Shortcode\Exception;

/**
 * Class MissingProcessorException
 * 
 * Thrown when the requested processor is not configured
 */
class MissingProcessorException extends \RuntimeException implements ExceptionInterface {
    
}