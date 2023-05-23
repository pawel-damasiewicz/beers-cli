<?php

namespace spec\PaulDam\BeersCli\Value;

use PaulDam\BeersCli\Value\LargeLabel;
use PhpSpec\ObjectBehavior;

class LargeLabelSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('http://example.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(LargeLabel::class);
    }

    public function it_does_return_url_string()
    {
        $url = 'https://example.com/img.png';
        $this->beConstructedWith($url);
        $this->getUrl()->shouldBe($url);
    }
}
