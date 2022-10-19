<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\Beer;
use PhpSpec\ObjectBehavior;

class BeerSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            'test_id',
            'Test name',
            'Test description',
            []
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Beer::class);
    }

    public function it_does_compare_only_ids_during_comparsion()
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
