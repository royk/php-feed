<?php
/**
 * @file atom.php
 * Template file for an Atom feed.
 * @author Duckson
 */

// Exit if the file isn't called from within an object.
if(!isset($this))
	exit;

// Item tags that should be treated as short tags
$items_shorttags = array(
	'link' => 'href'
);
// Property tags that should be treated as short tags
$properties_shorttags = array(
	'link' => array('href', 'rel'), 'category' => 'term',
);

echo '<?xml version="1.0" encoding="'.$this->getCharset().'"?>';
?>

<feed xmlns="http://www.w3.org/2005/Atom">
	
	<?php // Loop through the feed properties
	foreach($this->properties as $key => $value)
	{
		$out = '';
		
		if(array_key_exists($key, $properties_shorttags))
		{
			echo "<$key $properties_shorttags[$key]=\"$value\" /> \n";
		}
		elseif(is_string($value))
		{
			if($key == 'link')
				echo '<link href="'.$this->properties['atom:link'].'" rel="self" type="'.$this->getContentType().'" />'."\n";
			else
				echo "<$key>$value</$key> \n";
		}
		elseif(is_array($value))
		{
			// Madness to support the generator element
			if($key == 'generator')
			{
				if(is_string($value['version']))
					$version = "version=\"{$value['version']}\"";
				
				if(is_string($value['uri']))
					$uri = "uri=\"{$value['uri']}\"";
				
				echo "<$key $version $uri>{$value['name']}</$key> \n";
			}
			else
			{
				foreach($value as $akey => $avalue)
					$out .= "<$akey>$avalue</$akey> \n";
					
				echo "<$key>$out</$key> \n";
			}
		}
	}
	?>
	
	<?php // Loop through the feed entries
	foreach($this->items as $item): ?>
	<entry>
		<?php // Loop through the item's properties
		foreach($item as $key => $value)
		{
			if(array_key_exists($key, $items_shorttags))
			{
				echo "<$key $items_shorttags[$key]=\"$value\" /> \n";
			}
			elseif(is_string($value))
			{
				echo "<$key>$value</$key> \n";
			}
			elseif(is_array($value))
			{
				// Support for the author and contributor elements
				if($key == 'author' or $key == 'contributor')
				{
					foreach($value as $author)
					$out .= '<name>'.$author.'</name>';
					echo "<$key>$out</$key> \n";
				}
				else
				{
					echo "<$key> \n";
					foreach($value as $akey => $avalue)
						echo "<$akey>$avalue</$akey> \n";
					echo "</$key> \n";
				}
			}
		}
		?>
	</entry>
	<?php endforeach; ?>
</feed>