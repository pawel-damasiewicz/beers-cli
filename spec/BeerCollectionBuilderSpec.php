<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\Beer;
use PaulDam\BeersCli\BeerCollection;
use PaulDam\BeersCli\BeerCollectionBuilder;
use PaulDam\BeersCli\LabelCollectionBuilder;
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

    public function it_does_build_beer_from_data()
    {
        $data = [
            'data' => [
                [
                    'id'          => 'test_id',
                    'name'        => 'test name',
                    'description' => 'test description',
                    'labels'      => [],
                ],
            ],
        ];

        $this->fromData($data)[0]->shouldHaveType(Beer::class);
    }
}
