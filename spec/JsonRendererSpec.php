<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\BeerCollection;
use PaulDam\BeersCli\JsonRenderer;
use PhpSpec\ObjectBehavior;

class JsonRendererSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(JsonRenderer::class);
    }

    public function it_does_render_collection_as_json()
    {
        $data = new BeerCollection([]);
        $this->render($data)->shouldBe('[]');
    }
}
