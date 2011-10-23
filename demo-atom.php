<?php
/**
 * @file demo-atom.php
 * Atom feed demo
 */

// Include the files
include('classes/Feed.class.php');
include('classes/RSS.class.php');
include('classes/Atom.class.php');

// Set up a the Feed object
$myatom = new Atom('An Atom Feed', 'http://example.com/', 'Description of this feed.');

$feeditems = array(
	array(
		'title' => 'Example item',
		'link' => 'http://example.com/news/foo',
		'content' => 'Content goes here.',
		'published' => date(DateTime::ATOM, strtotime('17-09-2011 18:10')),
		'updated' => date(DateTime::ATOM, strtotime('17-09-2011 21:30')),
	),
	array(
		'title' => 'Another example item',
		'link' => 'http://example.com/blog/bar',
		'content' => 'Content goes here.',
		'published' => date(DateTime::ATOM, strtotime('12-08-2011 12:53')),
		'updated' => date(DateTime::ATOM, strtotime('13-08-2011 14:32')),
		'author' => 'Henk Ankerman'
	),
	array(
		'title' => 'Yet another example item',
		'link' => 'http://example.com/2011/01/example-item',
		'description' => 'Description goes here.',
		'content' => 'Some content.',
		'published' => date(DateTime::ATOM, strtotime('17-09-2011 21:30')),
		'updated' => date(DateTime::ATOM, strtotime('18-09-2011 12:24')),
	),
	array(
		'title' => 'Hallo Will',
		'link' => 'http://test.nl/',
		'published' => date(DateTime::ATOM, strtotime('16-09-2011 15:44'))
	),
);

// Add some feed items
$myatom->addItems($feeditems);

// Generate tag URI's for the Feed items
$myatom->generateTags();

// Add some properties
$myatom->setProperty('category', 'tech');
$myatom->setGenerator('PHP-Feed', '0.1', 'http://github.com/duckson/php-feed');
$myatom->addAuthor('Henk Ankerman', 'http://example.com/~henk/', 'henk@example.com');

$myatom->setProperty('rights', 'Copyleft 2011, Nobody');

// We're using text/plain here to make sure you can read the raw output
$myatom->setContentType('text/plain');

// Fetch the result into a variable
$output = $myatom->fetch();
echo $output;