<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

$containerBuilder = new ContainerBuilder();

$settings = require __DIR__ . '/config/settings.php';
$containerBuilder->addDefinitions($settings);
$container = $containerBuilder->build();

$doctrineSettings = $settings['settings']['doctrine'];
$doctrineConfig = Setup::createAnnotationMetadataConfiguration(
    $doctrineSettings['metadata_dirs'],
    $doctrineSettings['dev_mode']
);

$entityManager = EntityManager::create($doctrineSettings['connection'], $doctrineConfig);
$container->set('em', $entityManager);

$app = AppFactory::createFromContainer($container);

require_once __DIR__ . '/routes/api.php';