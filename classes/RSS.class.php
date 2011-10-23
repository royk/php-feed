<?php
/**
 * RSS class.
 * Generates RSS Feeds.
 * 
 * @author Duckson
 * @link http://cyber.law.harvard.edu/rss/ RSS Spec
 * @extends Feed
 */
class RSS extends Feed
{
	/**
	 * templatefile
	 * 
	 * (default value: 'includes/rss.php')
	 * @var string
	 * @access protected
	 */
	protected $templatefile = 'includes/rss.php';
	
	/**
	 * header
	 * The RSS MIME type.
	 * (default value: 'application/rss+xml')
	 * @var string
	 * @access protected
	 */
	protected $contenttype = 'application/rss+xml';
	
	/**
	 * RSS_VERSION
	 * The version of the RSS feed.
	 * (default value: '2.0')
	 */
	const RSS_VERSION = '2.0';
	
	/**
	 * __construct function.
	 * Set the required channel properties.
	 * @access public
	 * @param mixed $channelTitle
	 * @param mixed $channelLink
	 * @param mixed $channelDescription
	 * @return void
	 */
	public function __construct($channelTitle = '', $channelLink = '', $channelDescription = '')
	{
		parent::__construct();
		
		// Set the required channel properties
		$this->setProperty('title', $channelTitle);
		$this->setProperty('link', $channelLink);
		$this->setProperty('description', $channelDescription);
		
		// Set the last build date to the current date and time
		$this->setProperty('lastBuildDate', date(DateTime::RSS));
	}
	
	/**
	 * getVersion function.
	 * Get the RSS version.
	 * @access public
	 * @return void
	 */
	public function getVersion()
	{
		return self::RSS_VERSION;
	}
}