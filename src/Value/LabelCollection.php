<?php

namespace PaulDam\BeersCli\Value;

use PaulDam\BeersCli\Component\CollectionAbstract;

class LabelCollection extends CollectionAbstract
{
    protected string $elementType = LabelAbstract::class;
}
