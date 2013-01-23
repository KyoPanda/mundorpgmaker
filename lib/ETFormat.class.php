<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * The ETFormat class provides various formatting methods which can be performed on a string. It also includes
 * a way for plugins to hook in and add their own formatting methods.
 *
 * @package esoTalk
 */
class ETFormat extends ETPluggable {


/**
 * The content string to perform all formatting operations on.
 * @var string
 */
public $content = "";


/**
 * Whether or not to do "basic", inline-only formatting, i.e. don't embed YouTube videos, images, etc.
 * @var bool
 */
public $basic = false;


/**
 * Initialize the formatter with a content string on which all subsequent operations will be performed.
 *
 * @param string $content The content string.
 * @param bool $sanitize Whether or not to sanitize HTML in the content.
 * @return ETFormat
 */
public function init($content, $sanitize = true)
{
	// Clean up newline characters - make sure the only ones we are using are \n!
	$content = strtr($content, array("\r\n" => "\n", "\r" => "\n")) . "\n";

	// Set the content, and sanitize if necessary.
	$this->content = $sanitize ? sanitizeHTML($content) : $content;

	return $this;
}


/**
 * Turn "basic", inline-only formatting on or off.
 *
 * @param bool $basic Whether or not basic formatting should be on.
 * @return ETFormat
 */
public function basic($basic)
{
	$this->basic = $basic;
	return $this;
}


/**
 * Format the content string using a standard procedure and plugin hooks.
 *
 * @return ETFormat
 */
public function format()
{
	// Trigger the "before format" event, which can be used to strip out code blocks.
	$this->trigger("beforeFormat");

	// Trigger the "format" event, where all regular formatting can be applied (bold, italic, etc.)
	$this->trigger("format");

	// Trigger the "after format" event, where code blocks can be put back in.
	$this->trigger("afterFormat");

	return $this;
}


/**
 * Get the content string in its current state.
 *
 * @return string
 */
public function get()
{
	return trim($this->content);
}


/**
 * Clip the content string to a certain number of characters, appending "..." if necessary.
 *
 * @param int $characters The number of characters to clip to.
 * @return ETFormat
 */
public function clip($characters)
{
	// If the content string is already shorter than this, do nothing.
	if (strlen($this->content) <= $characters) return $this;

	// Cut the content down to the last full word that fits in this number of characters.
	$this->content = substr($this->content, 0, $characters);
	$this->content = substr($this->content, 0, strrpos($this->content, " "));

	// Append "...", and close all opened HTML tags.
	$this->content .= " ...";
	$this->closeTags();

	return $this;
}


/**
 * Close all unclosed HTML tags in the content string.
 *
 * @return ETFormat
 */
public function closeTags()
{
	// Put all opened tags into an array.
	preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $this->content, $result);
	$openedTags = $result[1];

	// Put all closed tags into an array.
	preg_match_all("#</([a-z]+)>#iU", $this->content, $result);
	$closedTags = $result[1];

	$numOpened = count($openedTags);

	// If there are the same number of opened tags as there are closed tags, we'll assume that they're all closed.
	if (count($closedTags) == $numOpened) return $this;

	// Go through the opened tags backwards, and close them one-by-one until we have no unclosed tags left.
	$openedTags = array_reverse($openedTags);
	for ($i = 0; $i < $numOpened; $i++) {

		// If there's no closing tag for this opening tag, append it.
		if (!in_array($openedTags[$i], $closedTags))
			$this->content .= "</".$openedTags[$i].">";

		// Otherwise, remove it from the closed tags array.
		else
			unset($closedTags[array_search($openedTags[$i], $closedTags)]);
	}

	return $this;
}

/**
 * Highlight a list of words in the content string.
 *
 * @return ETFormat
 */
public function highlight($words)
{
	$highlight = array_unique((array)$words);
	if (!empty($highlight)) $this->content = highlight($this->content, $highlight);

	return $this;
}

}