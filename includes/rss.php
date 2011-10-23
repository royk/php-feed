<?php
/**
 * @file rss.php
 * Template file for an RSS feed.
 * @author Duckson
 */

// Exit if the file isn't called from within an object.
if(!isset($this))
	exit;

echo '<?xml version="1.0" encoding="'.$this->getCharset().'"?>';
?>

<rss version="<?php echo $this->getVersion(); ?>" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
	
	<?php // Loop through the feed properties
	foreach($this->properties as $key => $value)
	{
		if($key == 'link')
			echo '<link href="'.$value.'" rel="self" type="'.$this->getContentType().'" />'."\n";
		else
			echo "<$key>$value</$key> \n";
	}
	?>
	
	<?php // Loop through the feed items
	foreach($this->items as $item): ?>
	<item>
		<?php
		foreach($item as $key => $value)
		{
			echo "<$key>$value</$key> \n";
		}
		?>
	</item>
	<?php endforeach; ?>

	</channel>
</rss>