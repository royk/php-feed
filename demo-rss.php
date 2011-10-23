<?php
/**
 * @file demo-rss.php
 * RSS feed demo
 */

// Include the files
include('classes/Feed.class.php');
include('classes/RSS.class.php');
include('classes/Atom.class.php');

// Set up a the Feed object
$myrss = new RSS('An RSS Feed', 'http://example.com/', 'Description of this feed.');

$feeditems = array(
	array(
		'title' => 'Example item',
		'link' => 'http://example.com/news/foo',
		'guid' => 'http://example.com/news/2011/09/17/foo',
		'description' => 'Description goes here.',
		'pubDate' => date(DateTime::RSS, strtotime('17-09-2011 21:30')),
		'category' => 'Tech'
	),
	array(
		'title' => 'Another example item',
		'link' => 'http://example.com/blog/bar',
		'description' => 'Description goes here.',
		'pubDate' => date(DateTime::RSS, strtotime('12-08-2011 12:53')),
		'guid' => Feed::generateTag('http://example.com/blog/bar', '12-08-2011 12:53'),
		'managingEditor' => 'ankerman@example.com (Henk Ankerman)'
	)
);

// Add some feed items
$myrss->addItems($feeditems);

// Add some properties
$myrss->setProperty('language', 'en-us');
$myrss->setProperty('generator', 'PHP');
$myrss->setProperty('link', 'http://bernson.eu/testfeed/demo-rss.php');

// We're using text/plain here to make sure you can read the raw output
$myrss->setContentType('text/plain');

// Fetch the result into a variable
$output = $myrss->fetch();
echo $output;