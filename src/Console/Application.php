<?php namespace PaulDam\BeersCli\Console;

use PaulDam\BeersCli\GuzzleBeerRepository;
use PaulDam\BeersCli\BeerRendererInterface;
use PaulDam\BeersCli\HtmlRenderer;
use PaulDam\BeersCli\WriterInterface;
use PaulDam\BeersCli\RendererFactory;

class Application
{
    private $container;

    /**
     * Inject container as collaborator
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $climate = $this->container->get(\League\CLImate\CLImate::class);

        $climate->arguments->add([
            'output' => [
                'prefix' => 'o',
                'longPrefix' => 'output',
                'description' => 'Sets output storage path',
                'defaultValue' => __DIR__ . '/../../storage',
            ],
            'help' => [
                'longPrefix'  => 'help',
                'description' => 'Prints a usage statement',
                'noValue'     => true,
            ],
            'format' => [
                'prefix' => 'f',
                'longPrefix' => 'format',
                'description' => 'Format of output',
                'defaultValue' => 'all',
            ],
        ]);

        $climate->arguments->parse();

        if ($climate->arguments->get('help')) {
            $climate->usage();

            exit(0);
        }

        $this->container->add(
            'config.storage.path',
            $climate->arguments->get('output')
        );

        $beers = $this->container
            ->get(GuzzleBeerRepository::class)
            ->filterByGlasswareId('1')
            ->getBeers();

        $format = $climate->arguments->get('format');

        $storage = $this->container->get('storage.' . $format);

        $storage->save($beers);
    }
}
