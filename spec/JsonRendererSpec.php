<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\JsonRenderer;
use PaulDam\BeersCli\BeerCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonRendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(JsonRenderer::class);
    }

    function it_does_render_collection_as_json()
    {
        $data = new BeerCollection([]);
        $this->render($data)->shouldBe('[]');
    }
}
