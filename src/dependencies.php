<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//flysystem
$container['storage'] = function ($c) {
	$settings = $c->get('settings')['storage'];
	$client = \Aws\S3\S3Client::factory([
		'credentials' => [
			'key' => $settings['do_spaces']['key'],
			'secret' => $settings['do_spaces']['secret'],
		],
		'region' => $settings['do_spaces']['region'],
                'endpoint' => $settings['do_spaces']['endpoint'],
		'version' => '2006-03-01',
	]);
	$adapter = new \League\Flysystem\AwsS3v3\AwsS3Adapter($client, $settings['do_spaces']['bucket']);
	return new \League\Flysystem\Filesystem($adapter);
};

//glide
$container['glide'] = function ($c) {
$server = League\Glide\ServerFactory::create([
    'source' =>                  $c->get('storage'),// Source filesystem
    'source_path_prefix' =>      'imagenation/source',// Source filesystem path prefix
    'cache' =>                   $c->get('storage'),// Cache filesystem
    'cache_path_prefix' =>       'imagenation/cache',// Cache filesystem path prefix
    'group_cache_in_folders' =>  true,// Whether to group cached images in folders
    'watermarks' =>              $c->get('storage'),// Watermarks filesystem
    'watermarks_path_prefix' =>  'imagenation/watermark',// Watermarks filesystem path prefix
    'max_image_size' =>          20000*20000,
    'driver' =>                  'gd',// Image driver (gd or imagick)
    'base_url' =>                'img',// Base URL of the images
    'response' =>                new \League\Glide\Responses\SlimResponseFactory()// Response factory
]);
return $server;
};


