<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\LabelCollection;
use PaulDam\BeersCli\LabelCollectionBuilder;
use PaulDam\BeersCli\LabelFactory;
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
