<?php

namespace spec\PaulDam\BeersCli\Renderer;

use PaulDam\BeersCli\Entity\BeerCollection;
use PaulDam\BeersCli\Renderer\JsonRenderer;
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
