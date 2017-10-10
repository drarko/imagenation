<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'api.imagenation.devteam.com.ar',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'storage' => [
            'do_spaces' => [
                'key' => 'Z2MFYFN2JSWBMC56IP3E',
                'secret' => 'vBvF4WPt0VYlnxMQOJ+n8wP46XGJ/XtcwUaJplN2ZMw',
                'region' => 'nyc3',
           	'bucket' => 'devteam',
                'endpoint' => 'https://nyc3.digitaloceanspaces.com'
            ],
        ],
    ],
];
