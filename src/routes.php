<?php
// Routes

$app->get('/random/[{path}]', function ($request, $response, $args) {
	$args["path"] .= ".jpg";
	return $this->glide->getImageResponse($args["path"],$request->getQueryParams());
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
