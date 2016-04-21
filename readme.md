# Shortcode

Shortcode is a library for parsing bbcode/shortcode written in PHP.
Inspiration and some code has been taken from the library thunderer/shortcode. Mostly the parser.

# Installation

There are no required dependencies and all PHP versions from 5.5 up to latest 7.0 are supported. 
This library is available on Composer/Packagist as doppy/shortcode, to install it execute:

````
composer require doppy/shortcode
````

Or if you do it manually:

````
"require": {
    "doppy/shortcode": "^0.1"
}
````

Run `composer install` or `composer update` afterwards.

# Usage

The library works with several components:

* `Syntax` objects hold the syntax to be used.
* `TagHandler`s are used to convert a found shortcode into something else. You will probably write your own to add functionality.
* `TagHandlerContainer`s hold multiple `TagHandler`s for the processor.
* `Processor` is used to parse and convert text. The Processor provided will probably do for all your needs.
* `processorContainer`s hold multiple processors. This is optional and only useful if you have multiple processors and you want to store them in one place.

## Symfony bundle

If you are using symfony, have a look at the symfony bundle that implements this for symfony `doppy/shortcode-bundle`.

# Example

Below is an example of how to use the library. Most of this is configuration.

````
// prepare parser
$syntax = new \Doppy\Shortcode\Syntax\Syntax();
$parser = new \Doppy\Shortcode\Parser\Parser($syntax);

// prepare TagHandlerContainer
$tagHandlerContainer = new \Doppy\Shortcode\TagHandlerContainer\TagHandlerContainer();
$tagHandlerContainer->addHandler(new \Doppy\Shortcode\TagHandler\SimpleTagHandler('b', 'b'));
$tagHandlerContainer->addHandler(new \Doppy\Shortcode\TagHandler\SimpleTagHandler('i', 'i'));
$tagHandlerContainer->addHandler(new \Doppy\Shortcode\TagHandler\SimpleTagHandler('span', 'span'));

// prepare a processor
$processor = new \Doppy\Shortcode\Processor\Processor(
    array(
        'max_depth' => 10,
        'handlers' => array('b', 'i'),
        'fallback_handler' => 'span'
    ),
    $parser,
    $tagHandlerContainer
);

$text = 'This is an [b]example[/b] of what you can do [b][i]with your text[/i][/b]';
$parsed = $processor->parse($text);
// Result: "This is an <b>example</b> of what you can do <b><i>with your text</i></b>"
````

## Notes:

* The `max_depth` flag determines how deep the parsing should go. Nested tags are parsed recursively, when max_depth is reached parsing is stopped.
* The `handlers` array determines what `TagHandler`s the processor is allowed to use.
* The `fallback_handler` determines what handler to use when no handler is found.

# TODO

* Improve readme
* Add more `TagHandler`s for most common tags.
* Add some tests