<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\BeerCollection;
use PaulDam\BeersCli\Beer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BeerCollectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BeerCollection::class);
    }

    function it_does_serialize_to_array()
    {
        $this->jsonSerialize()->shouldBe([]);
    }

    function it_does_check_element_type_during_instantiation()
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
