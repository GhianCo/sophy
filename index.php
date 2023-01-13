<?php
declare(strict_types=1);

use Sophy\Application\Handlers\HttpErrorHandler;
use Sophy\Application\Handlers\ShutdownHandler;
use Sophy\Application\ResponseEmitter\ResponseEmitter;
use Sophy\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

date_default_timezone_set('America/Lima');

$baseDir = __DIR__ . '/';

require $baseDir . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($baseDir);
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv->load();
}
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
    $containerBuilder->enableCompilation($baseDir . 'var/cache');
}

// Set up settings
$settings = require $baseDir . 'src/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require $baseDir . 'src/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require $baseDir . 'app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

/** @var SettingsInterface $settings */
$settings = $container->get(SettingsInterface::class);

$appSettings = $settings->get('app');
$displayErrorDetails = $settings->get('displayErrorDetails');
$logError = $settings->get('logError');
$logErrorDetails = $settings->get('logErrorDetails');

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->setBasePath($appSettings['basePath']);
$callableResolver = $app->getCallableResolver();

// Register routes
$api_routes = require $baseDir . 'app/routes.php';
$api_routes($app);


// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Body Parsing Middleware
$app->addBodyParsingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);
