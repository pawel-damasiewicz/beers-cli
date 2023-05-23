<?php

namespace spec\PaulDam\BeersCli\Value;

use PaulDam\BeersCli\Value\LabelCollection;
use PaulDam\BeersCli\Value\LabelCollectionBuilder;
use PaulDam\BeersCli\Value\LabelFactory;
use PhpSpec\ObjectBehavior;

class LabelCollectionBuilderSpec extends ObjectBehavior
{
    public function let(LabelFactory $factory)
    {
        $this->beConstructedWith($factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(LabelCollectionBuilder::class);
    }

    public function it_does_return_label_collection()
    {
        $this->fromData([])->shouldHaveType(LabelCollection::class);
    }
}
