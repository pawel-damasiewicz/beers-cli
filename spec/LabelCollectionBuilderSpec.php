<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\LabelCollectionBuilder;
use PaulDam\BeersCli\LabelCollection;
use PaulDam\BeersCli\LabelFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LabelCollectionBuilderSpec extends ObjectBehavior
{
    function let(LabelFactory $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LabelCollectionBuilder::class);
    }

    function it_does_return_label_collection()
    {
        $this->fromData([])->shouldHaveType(LabelCollection::class);
    }
}
