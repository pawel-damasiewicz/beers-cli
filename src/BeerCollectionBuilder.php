<?php

namespace PaulDam\BeersCli;

class BeerCollectionBuilder
{
    public function __construct(
        private readonly LabelCollectionBuilder $labelCollectionBuilder
    ) { }

    public function fromData(array $data): BeerCollection
    {
        $beersArray = array_map(function ($beerData) {
            $labelsData = $beerData['labels'] ?? [];
            $labelsData = $labelsData === null ? [] : $labelsData;

            return new Beer(
                $beerData['id'],
                $beerData['name'],
                $beerData['description'] ?? '',
                $this->labelCollectionBuilder->fromData($labelsData)
            );
        }, $data['data']);

        return new BeerCollection($beersArray);
    }
}
