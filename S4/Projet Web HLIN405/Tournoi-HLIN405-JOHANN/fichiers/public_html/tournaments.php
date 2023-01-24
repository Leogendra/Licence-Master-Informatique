<?php 

require_once __DIR__ . '/site-header.php';

$page = new PH\Templates\BootstrapPage();
$page->setPermissionsNeeded(Role::All);
$page->forbidAccessIfNotPermitted();
$page->setBody(ph_get_body('tournaments.php'));
$page->setTitle('Parcourir les tournois');
$page->addStylesheets(array(
    ph_create_css_object('tournaments.css'),
));
$page->addScripts(array(
    ph_create_js_object('class-filter.js'),
    ph_create_js_object('tournaments-search.js'),
));
$page->render();