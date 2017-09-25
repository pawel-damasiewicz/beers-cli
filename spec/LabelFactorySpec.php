<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\LabelFactory;
use PaulDam\BeersCli\LargeLabel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LabelFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LabelFactory::class);
    }

    function it_does_create_large_label()
    {
        $this->build('large', 'https://some-image-url.example.com/img.png')
            ->shouldHaveType(LargeLabel::class);
    }

    function it_does_throw_exception_for_unsupported_labels()
    {
        $this->shouldThrow(new \Exception('Unsupported label type.'))
            ->duringBuild('extra-small', 'https://url.example.com/img.png');
    }
}
