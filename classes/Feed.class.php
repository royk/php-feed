<?php
/**
 * Abstract Feed class.
 * Base for XML feeds.
 * 
 * @author Duckson
 * @abstract
 */
abstract class Feed
{
	/**
	 * properties
	 * Feed properties
	 * Such as <title>, <link>, <description>.
	 * (default value: array())
	 * @var array
	 * @access protected
	 */
	protected $properties = array();
	
	/**
	 * items
	 * Feed items
	 * (default value: array())
	 * @var array
	 * @access protected
	 */
	protected $items = array();
	
	/**
	 * header
	 * The channel's HTTP header.
	 * (default value: 'application/xml')
	 * @var string
	 * @access protected
	 */
	protected $contenttype = 'application/xml';
	
	/**
	 * sendHeaders
	 * Whether or not to send the HTTP headers.
	 * (default value: true)
	 * @var bool
	 * @access protected
	 */
	protected $sendHeaders = true;
	
	/**
	 * timezone
	 * The current timezone of the Feed.
	 * (default value: 'Europe/Amsterdam')
	 * @var string
	 * @access protected
	 */
	protected $timezone = 'Europe/Amsterdam';
	
	/**
	 * charset
	 * The Feed's character set.
	 * (default value: 'utf-8')
	 * @var string
	 * @access protected
	 */
	protected $charset = 'utf-8';
	
	/**
	 * templatefile
	 * The Feed's template file,
	 * to generate the output from.
	 * (default value: '')
	 * @var string
	 * @access protected
	 */
	protected $templatefile = '';
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param string $timezone (default: '')
	 * @return void
	 */
	public function __construct($timezone = '')
	{
		if(empty($timezone))
			$timezone = $this->timezone;
		
		date_default_timezone_set($timezone);
	}
	
	/**
	 * __destruct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{}
	
	/**
	 * __clone function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __clone()
	{}
	
	/**
	 * addItem function.
	 * Add a single Feed item to the items array.
	 * @access public
	 * @param mixed $item
	 * @return bool
	 */
	public function addItem($item)
	{
		if(is_array($item))
		{
			$this->items[] = $item;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * getItem function.
	 * Get a feed item.
	 * @access public
	 * @param mixed $key
	 * @return string|void
	 */
	public function getItem($key)
	{
		if(array_key_exists($key, $this->items))
		{
			return $this->items[$key];
		}
		else
		{
			return null;
		}
	}
	
	/**
	 * removeItem function.
	 * Remove a Feed item.
	 * @access public
	 * @param mixed $key
	 * @return bool
	 */
	public function removeItem($key)
	{
		if(array_key_exists($key, $this->items))
		{
			unset($this->items[$key]);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * addItems function.
	 * Add an array with multiple items to the items array.
	 * @access public
	 * @param mixed $items
	 * @return bool
	 */
	public function addItems($items)
	{
		if(is_array($items))
		{
			$this->items = array_merge($this->items, $items);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * getItems function.
	 * Get the current Feed items.
	 * @access public
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}
	
	/**
	 * setProperty function.
	 * Set a Feed property.
	 * @access public
	 * @param string $key
	 * @param string $value (default: null)
	 * @return void
	 */
	public function setProperty($key, $value = null)
	{
		$this->properties[$key] = $value;
	}
	
	/**
	 * getProperty function.
	 * Get a feed property.
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function getProperty($key)
	{
		if(array_key_exists($key, $this->properties))
		{
			return $this->properties[$key];
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * deleteProperty function.
	 * Delete a feed property.
	 * @access public
	 * @param mixed $key
	 * @return bool
	 */
	public function unsetProperty($key)
	{
		if(array_key_exists($key, $this->properties))
		{
			unset($this->properties[$key]);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * flushProperties function.
	 * Flush the properties array.
	 * @access public
	 * @return void
	 */
	public function flushProperties()
	{
		$this->properties = array();
	}
	
	/**
	 * flushItems function.
	 * Flush the items array.
	 * @access public
	 * @return void
	 */
	public function flushItems()
	{
		$this->items = array();
	}
	
	/**
	 * flush function.
	 * Flush the items and properties arrays.
	 * @access public
	 * @return void
	 */
	public function flush()
	{
		$this->items = array();
		$this->properties = array();
	}
	
	/**
	 * setSendHeaders function.
	 * Tell whether to send the headers or not.
	 * @access public
	 * @param bool $b
	 * @return void
	 */
	public function setSendHeaders($b)
	{
		if(is_bool($b))
		{
			$this->sendHeaders = $b;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * sendHeaders function.
	 * Send out the HTTP headers for the feed.
	 * @access public
	 * @return bool
	 */
	public function sendHeaders()
	{
		if($this->sendHeaders == true and 
			header('Content-type: '.$this->contenttype))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * getHeader function.
	 * Get the Feed's content-type/MIME type.
	 * @access public
	 * @return string
	 */
	public function getContentType()
	{
		return $this->contenttype;
	}
	
	/**
	 * setHeader function.
	 * Set the Feed's content-type/MIME type.
	 * @access public
	 * @param mixed $header
	 * @return void
	 */
	public function setContentType($type)
	{
		$this->contenttype = $type;
	}
	
	/**
	 * getTimezone function.
	 * Get the Feed's timezone.
	 * @access public
	 * @return string
	 */
	public function getTimezone()
	{
		return $this->timezone;
	}
	
	/**
	 * setTimezone function.
	 * Set the Feed's timezone.
	 * @access public
	 * @param mixed $timezone
	 * @return void
	 */
	public function setTimezone($timezone)
	{
		$this->timezone = $timezone;
		date_default_timezone_set($this->timezone);
	}
	
	/**
	 * getCharset function.
	 * Get the Feed's character set.
	 * @access public
	 * @return void
	 */
	public function getCharset()
	{
		return $this->charset;
	}
	
	/**
	 * setCharset function.
	 * Set the Feed's character set.
	 * @access public
	 * @param mixed $cs
	 * @return void
	 */
	public function setCharset($cs)
	{
		if(is_string($cs))
		{
			$this->charset = $cs;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * getTemplatefile function.
	 * Get the location of the template file.
	 * @access public
	 * @return string
	 */
	public function getTemplatefile()
	{
		return $this->templatefile;
	}
	
	/**
	 * setTemplatefile function.
	 * Set the location of the template file.
	 * @access public
	 * @param mixed $path
	 * @return void
	 */
	public function setTemplatefile($path)
	{
		$this->templatefile = $path;
	}
	
	/**
	 * generateTag function.
	 * Generate a Tag URI.
	 * @link http://www.taguri.org/
	 * @access protected
	 * @param mixed $url
	 * @return string
	 */
	public static function generateTag($url, $date)
	{
		$urlar = parse_url($url);
		extract($urlar);
		
		if(isset($fragment))
		{
			$path .= '/'.$fragment;
			$path = str_replace('//', '/', $path);
		}
		
		$date = date('Y-m-d', strtotime($date));
		
		$tag = 'tag:'.$host.','.$date.':'.$path;
		return $tag;
	}
	
	/**
	 * display function.
	 * Send the template output to the output buffer.
	 * @access public
	 * @return void
	 */
	public function display()
	{
		if(file_exists($this->templatefile))
		{
			include($this->templatefile);
		}
		else
		{
			throw new FeedException(
				'The template file could not be not found.'
			);
		}
	}
	
	/**
	 * fetch function.
	 * Catch the template output and return it.
	 * @access public
	 * @return string
	 */
	public function fetch()
	{
		// Send the HTTP headers
		$this->sendHeaders();
		
		// Start output-buffering, catch it in the output variable
		ob_start();
		$this->display();
		$output = ob_get_clean();
		
		return $output;
	}
}

/**
 * FeedException class.
 * 
 * @extends Exception
 */
class FeedException extends Exception
{
}