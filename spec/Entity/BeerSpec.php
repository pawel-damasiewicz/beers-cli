<?php

namespace spec\PaulDam\BeersCli\Entity;

use PaulDam\BeersCli\Entity\Beer;
use PaulDam\BeersCli\Value\LabelCollection;
use PhpSpec\ObjectBehavior;

class BeerSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            'test_id',
            'Test name',
            'Test description',
            new LabelCollection([])
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
            new LabelCollection([])
        );

        $this->equals($otherBeer)->shouldBe(true);
    }

    public function it_does_have_labels()
    {
        $this->getLabels()->shouldHaveType(LabelCollection::class);
    }
}
