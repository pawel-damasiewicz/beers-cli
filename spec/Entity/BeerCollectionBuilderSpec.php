<?php

namespace spec\PaulDam\BeersCli\Entity;

use PaulDam\BeersCli\Entity\BeerCollection;
use PaulDam\BeersCli\Entity\BeerCollectionBuilder;
use PaulDam\BeersCli\Value\LabelCollectionBuilder;
use PhpSpec\ObjectBehavior;

class BeerCollectionBuilderSpec extends ObjectBehavior
{
    public function let(LabelCollectionBuilder $labelCollectionBuilder)
    {
        $this->beConstructedWith($labelCollectionBuilder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BeerCollectionBuilder::class);
    }

    public function it_does_return_beer_collection()
    {
        $data = ['data' => []];

        $this->fromData($data)->shouldHaveType(BeerCollection::class);
    }
}
