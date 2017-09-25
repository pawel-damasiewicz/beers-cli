<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\Beer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BeerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'test_id',
            'Test name',
            'Test description',
            []
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Beer::class);
    }

    function it_does_compare_only_ids_during_comparsion()
    {
        $otherBeer = new Beer(
            'test_id',
            'some name',
            'description',
            []
        );

        $this->equals($otherBeer)->shouldBe(true);
    }
}
