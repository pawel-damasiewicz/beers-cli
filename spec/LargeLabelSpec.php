<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\LargeLabel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LargeLabelSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('http://example.com');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LargeLabel::class);
    }

    function it_does_return_url_string()
    {
        $url = 'https://example.com/img.png';
        $this->beConstructedWith($url);
        $this->getUrl()->shouldBe($url);
    }
}
