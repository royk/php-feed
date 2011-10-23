<?php
/**
 * Atom class.
 * Generatos Atom Feeds.
 * 
 * @author Duckson
 * @link http://www.atomenabled.org/developers/syndication/ Atom Spec
 * @extends Feed
 */
class Atom extends Feed
{
	/**
	 * templatefile
	 * 
	 * (default value: 'includes/atom.php')
	 * @var string
	 * @access protected
	 */
	protected $templatefile = 'includes/atom.php';
	
	/**
	 * header
	 * The Atom MIME type.
	 * (default value: 'application/atom+xml')
	 * @var string
	 * @access protected
	 */
	protected $contenttype = 'application/atom+xml';
	
	protected $generateTags = true;
	
	/**
	 * __construct function.
	 * Set the required element properties.
	 * @access public
	 * @param mixed $channelTitle
	 * @param mixed $channelId
	 * @param mixed $channelDescription
	 * @return void
	 */
	public function __construct($channelTitle = '', $channelId = '')
	{
		parent::__construct();
		
		// Set the required channel elements
		$this->setProperty('title', $channelTitle);
		
		/**
		 * The channel ID "Identifies the feed using a universally unique and permanent URI"
		 * See: http://www.atomenabled.org/developers/syndication/#requiredFeedElements
		 */
		$this->setProperty('id', $channelId);
		
		// Set the last build date to the current date and time
		$this->setProperty('updated', date(DateTime::ATOM));
	}
	
	/**
	 * addAuthor function.
	 * Add an author construct to the feed properties.
	 * @access public
	 * @param mixed $name
	 * @param mixed $uri (default: null)
	 * @param mixed $email (default: null)
	 * @return void
	 */
	public function addAuthor($name, $uri = null, $email = null)
	{
		//$slug = str_replace(' ', '-', strtolower($name));
		$authorinfo = array(
			'name' => $name
		);
		
		if(is_string($uri))
			$authorinfo['uri'] = $uri;
			
		if(is_string($email))
			$authorinfo['email'] = $email;
		
		$this->setProperty('author', $authorinfo);
	}
	
	public function setGenerator($name, $version = null, $uri = null)
	{
		$generator = array('name' => $name);
		
		if(isset($version))
			$generator['version'] = $version;
		
		if(is_string($uri))
			$generator['uri'] = $uri;
		
		$this->setProperty('generator', $generator);
	}
	
	/**
	 * generateTags function.
	 * Generate tag URI's for the feed items where possible.
	 * @link http://www.taguri.org/
	 * @access public
	 * @return void
	 */
	public function generateTags()
	{
		foreach($this->items as &$item)
		{
			if(array_key_exists('link', $item) and array_key_exists('published', $item))
			{
				$item['id'] = $this->generateTag($item['link'], $item['published']);
			}
		}
	}
	
	/**
	 * fetch function.
	 * Catch the Atom output and return it.
	 * @access public
	 * @return string
	 */
	public function fetch()
	{
		// Generate the tag URI's
		if($this->generateTags == true)
			$this->generateTags();
		
		// Send the HTTP headers
		$this->sendHeaders();
		
		// Start output-buffering, catch it in the output variable
		ob_start();
		$this->display();
		$output = ob_get_clean();
		
		return $output;
	}
}