<?php

namespace spec\PaulDam\BeersCli\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PaulDam\BeersCli\Entity\BeerCollection;
use PaulDam\BeersCli\Entity\BeerCollectionBuilder;
use PaulDam\BeersCli\Repository\GuzzleBeerRepository;
use PhpSpec\ObjectBehavior;

class GuzzleBeerRepositorySpec extends ObjectBehavior
{
    public function let(Client $client, BeerCollectionBuilder $builder)
    {
        $this->beConstructedWith($client, $builder, []);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GuzzleBeerRepository::class);
    }

    public function it_does_return_beer_collection($client, $builder)
    {
        $client->request('GET', 'beers', ['query' => ['glasswareId' => []]])
            ->willReturn(new Response(200, [], '{"test":"data"}'))
            ->shouldBeCalled();

        $builder->fromData(['test' => 'data'])
            ->willReturn(new BeerCollection([]))
            ->shouldBeCalled();

        $this->getBeers()->shouldHaveType(BeerCollection::class);
    }
}
