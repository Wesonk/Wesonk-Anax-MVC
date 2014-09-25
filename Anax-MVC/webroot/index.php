<?php
require __DIR__.'/config_with_app.php';

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Start");
    $content = $app->fileContent->get('presentation.md');
    $content = $app->textFilter->doFilter($content,'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page',['content'=> $content,'byline'=>$byline,]);


    // if edit isn't loaded then do this
    if(!$app->request->getPost('edit')){
        $app->views->add('comment/form', [
            'mail' => null,
            'web' => null,
            'name' => null,
            'content' => null,
            'output' => null,
        ]);
    }

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);
    $app->theme->addJavaScript('js/comment.js');
    $app->theme->addStylesheet('css/comment.css');

});

$app->router->add('redovisning', function() use ($app) {

    $app->theme->setTitle("Redovisning");

    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
});

$app->router->add('php-mvc-kmom1', function() use ($app) {

    $app->theme->setTitle("Kmom01: PHP-baserade och MVC-inspirerade ramverk");

    $content = $app->fileContent->get('kmom1.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);

    // if edit isn't loaded then do this
    if(!$app->request->getPost('edit')){
        $app->views->add('comment/form', [
            'mail' => null,
            'web' => null,
            'name' => null,
            'content' => null,
            'output' => null,
        ]);
    }

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);
    $app->theme->addJavaScript('js/comment.js');
    $app->theme->addStylesheet('css/comment.css');
});


$app->router->add('source', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källa");

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);

});

$app->router->add('dice-app', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Redovisning");

    $app->views->add('dice/index');

});


// Route to roll dice and show results
$app->router->add('dice-app/roll', function() use ($app) {

    // Check how many rolls to do
    $roll = $app->request->getGet('roll', 1);
    $app->validate->check($roll, ['int', 'range' => [1, 100]])
    or die("Roll out of bounds");

    // Make roll and prepare reply
    $dice = new \Mos\Dice\CDice();
    $dice->roll($roll);

    $app->theme->addStylesheet('css/dice.css');

    $app->views->add('dice/index', [
        'roll'      => $dice->getNumOfRolls(),
        'results'   => $dice->getResults(),
        'total'     => $dice->getTotal(),
    ]);

    $app->theme->setTitle("Rolled a dice");

});


$app->router->handle();
$app->theme->render();