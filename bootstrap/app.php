<?php

use PaulDam\BeersCli;

/**
 * Instantiate container.
 */
$container = new League\Container\Container();

/**
 * Register configuration for services.
 */
if (is_file($config = __DIR__.'/../config/beersdb.php')) {
    $config = require $config;
} else {
    fwrite(STDERR, 'Configuration file not found.');
    exit(1);
}

$container->add('config.beersdb', $config);

$container->add('config.twig', function () use ($config) {
    return $config['twig'];
});

$container->add('config.twig.templatesPath', function () use ($config) {
    return $config['twig']['templatesPath'];
});

$container->add('config.httpClient', function () use ($container, $config) {
    $config = $config['client_options'];
    $config['handler'] = $container->get(\GuzzleHttp\HandlerStack::class);

    return $config;
});

$container->add('config.climate', function () use ($config) {
    return $config['climate'];
});

/**
 * Register services.
 */
$container->add(\GuzzleHttp\HandlerStack::class, function () {
    $handler = new \GuzzleHttp\Handler\CurlHandler();

    return \GuzzleHttp\HandlerStack::create($handler);
});

$container->add(\GuzzleHttp\Client::class)
    ->addArgument('config.httpClient');

$container->add(BeersCli\Value\LabelFactory::class, BeersCli\Value\LabelFactory::class);

$container
    ->add(BeersCli\Value\LabelCollectionBuilder::class)
    ->addArgument(BeersCli\Value\LabelFactory::class);

$container
    ->add(BeersCli\Entity\BeerCollectionBuilder::class)
    ->addArgument(BeersCli\Value\LabelCollectionBuilder::class);

$container
    ->add(BeersCli\Repository\GuzzleBeerRepository::class)
    ->addArgument(\GuzzleHttp\Client::class)
    ->addArgument(BeersCli\Entity\BeerCollectionBuilder::class)
    ->addArgument('config.beersdb');

$container->add(BeersCli\Repository\MockBeerRepository::class)
    ->addArgument(BeersCli\Entity\BeerCollectionBuilder::class);

$container->add(
    BeersCli\Repository\BeerRepositoryInterface::class,
    function () use ($container) {
        return $container->get(BeersCli\Repository\MockBeerRepository::class);
    }
);

$container->add(BeersCli\Renderer\TemplateRenderer::class)
    ->addArgument(\Twig\Environment::class);

$container->add(BeersCli\Renderer\JsonRenderer::class, BeersCli\Renderer\JsonRenderer::class);

$container->add('renderer.html', function () use ($container) {
    return $container->get(BeersCli\Renderer\TemplateRenderer::class)
        ->withTemplate('beers.html');
});

$container->add('renderer.xml', function () use ($container) {
    return $container->get(BeersCli\Renderer\TemplateRenderer::class)
        ->withTemplate('beers.html');
});

$container->add(\Twig\Environment::class)
    ->addArgument(\Twig\Loader\FilesystemLoader::class)
    ->addArgument('config.twig');

$container->add(\Twig\Loader\FilesystemLoader::class)
    ->addArgument('config.twig.templatesPath');

$container->add(\League\CLImate\CLImate::class);

$container->add(BeersCli\Component\WriterInterface::class, BeersCli\Writer\FileWriter::class);

$container->add(BeersCli\Renderer\RendererFactory::class, function () use ($container) {
    return new BeersCli\Renderer\RendererFactory($container);
});

$container->add(BeersCli\Writer\WriterFactory::class, BeersCli\Writer\WriterFactory::class);

$container->add(BeersCli\Storage\StorageFactory::class)
    ->addArgument(BeersCli\Renderer\RendererFactory::class)
    ->addArgument(BeersCli\Writer\WriterFactory::class);

$container->add('storage.xml', function () use ($container) {
    $factory = $container->get(BeersCli\Storage\StorageFactory::class);

    return $factory->build(
        'xml',
        $container->get('config.storage.path')
    );
});

$container->add('storage.html', function () use ($container) {
    $factory = $container->get(BeersCli\Storage\StorageFactory::class);

    return $factory->build(
        'html',
        $container->get('config.storage.path')
    );
});

$container->add('storage.json', function () use ($container) {
    $factory = $container->get(BeersCli\Storage\StorageFactory::class);

    return $factory->build(
        'json',
        $container->get('config.storage.path')
    );
});

$container->add('storage.all', function () use ($container) {
    $factory = $container->get(BeersCli\Storage\StorageFactory::class);

    return $factory->build(
        'all',
        $container->get('config.storage.path')
    );
});

/**
 * Return container.
 */
return $container;
