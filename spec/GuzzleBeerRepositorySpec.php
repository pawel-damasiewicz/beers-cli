<?php

namespace spec\PaulDam\BeersCli;

use PaulDam\BeersCli\GuzzleBeerRepository;
use PaulDam\BeersCli\Beer;
use PaulDam\BeersCli\BeerCollectionBuilder;
use PaulDam\BeersCli\BeerCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GuzzleBeerRepositorySpec extends ObjectBehavior
{
    function let(Client $client, BeerCollectionBuilder $builder)
    {
        $this->beConstructedWith($client, $builder, []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GuzzleBeerRepository::class);
    }

    function it_does_return_beer_collection($client, $builder)
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
