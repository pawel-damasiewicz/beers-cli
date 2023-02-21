<?php

namespace PaulDam\BeersCli;

class LabelCollectionBuilder
{
    public function __construct(private readonly LabelFactory $labelFactory) { }

    public function fromData($labels): LabelCollection
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
