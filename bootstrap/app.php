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

$container->add(BeersCli\LabelFactory::class, BeersCli\LabelFactory::class);

$container
    ->add(BeersCli\LabelCollectionBuilder::class)
    ->addArgument(BeersCli\LabelFactory::class);

$container
    ->add(BeersCli\BeerCollectionBuilder::class)
    ->addArgument(BeersCli\LabelCollectionBuilder::class);

$container
    ->add(BeersCli\GuzzleBeerRepository::class)
    ->addArgument(\GuzzleHttp\Client::class)
    ->addArgument(BeersCli\BeerCollectionBuilder::class)
    ->addArgument('config.beersdb');

$container->add(
    BeersCli\BeerRepositoryInterface::class,
    BeersCli\GuzzleBeerRepository::class
);

$container->add(BeersCli\TemplateRenderer::class)
    ->addArgument(\Twig\Environment::class);

$container->add(BeersCli\JsonRenderer::class, BeersCli\JsonRenderer::class);

$container->add('renderer.html', function () use ($container) {
    return $container->get(BeersCli\TemplateRenderer::class)
        ->withTemplate('beers.html');
});

$container->add('renderer.xml', function () use ($container) {
    return $container->get(BeersCli\TemplateRenderer::class)
        ->withTemplate('beers.html');
});

$container->add(\Twig\Environment::class)
    ->addArgument(\Twig\Loader\FilesystemLoader::class)
    ->addArgument('config.twig');

$container->add(\Twig\Loader\FilesystemLoader::class)
    ->addArgument('config.twig.templatesPath');

$container->add(\League\CLImate\CLImate::class);

$container->add(BeersCli\WriterInterface::class, BeersCli\FileWriter::class);

$container->add(BeersCli\RendererFactory::class, function () use ($container) {
    return new BeersCli\RendererFactory($container);
});

$container->add(BeersCli\WriterFactory::class, BeersCli\WriterFactory::class);

$container->add(BeersCli\StorageFactory::class)
    ->addArgument(BeersCli\RendererFactory::class)
    ->addArgument(BeersCli\WriterFactory::class);

$container->add('storage.xml', function () use ($container) {
    $factory = $container->get(BeersCli\StorageFactory::class);

    return $factory->build(
        'xml',
        $container->get('config.storage.path')
    );
});

$container->add('storage.html', function () use ($container) {
    $factory = $container->get(BeersCli\StorageFactory::class);

    return $factory->build(
        'html',
        $container->get('config.storage.path')
    );
});

$container->add('storage.json', function () use ($container) {
    $factory = $container->get(BeersCli\StorageFactory::class);

    return $factory->build(
        'json',
        $container->get('config.storage.path')
    );
});

$container->add('storage.all', function () use ($container) {
    $factory = $container->get(BeersCli\StorageFactory::class);

    return $factory->build(
        'all',
        $container->get('config.storage.path')
    );
});

/**
 * Return container.
 */
return $container;
