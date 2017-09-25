<?php namespace PaulDam\BeersCli;

class BeerCollectionBuilder
{
    public function __construct(
        LabelCollectionBuilder $labelCollectionBuilder
    ) {
        $this->labelCollectionBuilder = $labelCollectionBuilder;
    }

    public function fromData(array $data)
    {
        $beersArray = array_map(function ($beerData) {
            $labelsData = isset($beerData['labels']) ? $beerData['labels'] : [];
            $labelsData = $labelsData === null ? [] : $labelsData;

            return new Beer(
                $beerData['id'],
                $beerData['name'],
                isset($beerData['description']) ? $beerData['description'] : '',
                $this->labelCollectionBuilder->fromData($labelsData)
            );
        }, $data['data']);

        return new BeerCollection($beersArray);
    }
}
