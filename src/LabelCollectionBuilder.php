<?php

namespace PaulDam\BeersCli;

class LabelCollectionBuilder
{
    public function __construct(LabelFactory $labelFactory)
    {
        $this->labelFactory = $labelFactory;
    }

    public function fromData($labels)
    {
        $labelArray = [];
        foreach ($labels as $name => $url) {
            try {
                $labelArray[] = $this->labelFactory->build($name, $url);
            } catch (\Exception $e) {
                continue;
            }
        }

        return new LabelCollection($labelArray);
    }
}
