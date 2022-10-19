<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\Beer;
use PaulDam\BeersCli\BeerCollection;
use PhpSpec\ObjectBehavior;

class BeerCollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BeerCollection::class);
    }

    public function it_does_serialize_to_array()
    {
        $this->jsonSerialize()->shouldBe([]);
    }

    public function it_does_check_element_type_during_instantiation()
    {
        $beers = [
            new Beer('', '', '', []),
        ];

        $this->beConstructedWith($beers);

        $beers = [
            [
                'some' => 'array',
            ],
        ];

        $this->beConstructedWith($beers);
        $this->shouldThrow(new \InvalidArgumentException(
            'PaulDam\BeersCli\BeerCollection can only contain PaulDam\BeersCli\Beer objects.'
        ))->duringInstantiation();
    }
}
