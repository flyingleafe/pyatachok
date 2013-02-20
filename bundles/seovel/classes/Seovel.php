<?php
/**
 * Main class handling all together
 * --------------------------------
 * @package seovel
 */
class Seovel
{
	//Variable which stores current instance
	private static $instance;

	//Variables which store default title params
	private static $def_title;
	private static $def_title_prefix;
	private static $def_title_suffix;

	//Variables which store default description and tags
	private static $def_description;
	private static $def_tags = array();

	//Non-default params
	private $title;
	private $description;
	private $tags;

	private $withoutPrefix = false;
	private $withoutSuffix = false;

	private function __construct() {
		return $this;
	}

	public static function init()
	{
		if(self::$instance == NULL) self::$instance = new Seovel;
		return self::$instance;
	}

	/**
	 * Displays the title
	 * @return string
	 */
	public static function title()
	{
		$title = self::$instance->title or self::$def_title;

		//add prefix, unless otherwise specified
		if(!self::$instance->withoutPrefix) {
			$title = self::$def_title_prefix . $title;
		}

		//add suffix, unless otherwise specified
		if(!self::$instance->withoutSuffix) {
			$title.= self::$def_title_suffix;
		}

		return "<title>$title</title>";
	}

	/**
	 * Displays the description
	 * @return string
	 */
	public static function description()
	{
		$desc = self::$instance->description or self::$def_description;
		return "<meta name='description' content='$desc' />";
	}

	/**
	 * Displays meta-tags
	 * @return string
	 */
	public static function tags()
	{
		# code...
	}

	public static function defaultTitle($title)
	{
		self::$def_title = $title;
		return self::$instance;
	}

	public static function defaultTitlePrefix($prefix)
	{
		self::$def_title_prefix = $prefix;
		return self::$instance;
	}

	public static function defaultTitleSuffix($suffix)
	{
		self::$def_title_suffix = $suffix;
		return self::$instance;
	}

	public static function defaultDescription($desc)
	{
		self::$def_description = $desc;
		return self::$instance;
	}

	public static function setTitle($title)
	{
		self::$instance->title = $title;
		return self::$instance;
	}

	public static function setDescription($desc)
	{
		self::$instance->description = $desc;
		return self::$instance;
	}

	public function noPrefix()
	{
		$this->withoutPrefix = true;
		return $this;
	}

	public function noSuffix()
	{
		$this->withoutSuffix = true;
		return $this;
	}
}