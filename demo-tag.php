<pre>
<?php
/**
 * Tag URI demo
 */

include('classes/Feed.class.php');
include('classes/Atom.class.php');

date_default_timezone_set('Europe/Amsterdam');

echo Feed::generateTag('http://diveintomark.org/archives/2004/05/28/howto-atom-id/#tag', 'yesterday')."\n";
echo Feed::generateTag('http://nl2.php.net/manual/en/function.date.php', '29 sept 2011')."\n";
echo Feed::generateTag('http://blog.cocoia.com/2011/pixel-blocks-wallpaper/', '29 sept 2011')."\n";
echo Feed::generateTag('http://mathijs.bernson.eu/blog#ohai', '21 oct 2011');
