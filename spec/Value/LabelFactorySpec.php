<?php

namespace spec\PaulDam\BeersCli\Value;

use PaulDam\BeersCli\Value\LabelFactory;
use PaulDam\BeersCli\Value\LargeLabel;
use PhpSpec\ObjectBehavior;

class LabelFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(LabelFactory::class);
    }

    public function it_does_create_large_label()
    {
        $this->build('large', 'https://some-image-url.example.com/img.png')
            ->shouldHaveType(LargeLabel::class);
    }

    public function it_does_throw_exception_for_unsupported_labels()
    {
        $this->shouldThrow(new \Exception('Unsupported label type.'))
            ->duringBuild('extra-small', 'https://url.example.com/img.png');
    }
}
