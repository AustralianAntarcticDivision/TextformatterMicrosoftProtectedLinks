<?php namespace ProcessWire;

/**
 * ProcessWire TextformatterMicrosoftProtectedLinks
 *
 * Find and replaces Microsoft protected links from Outlook/Teams/Office
 * with the original links.
 *
 * @author Australian Antarctic Division
 * @copyright 2025 Commonwealth of Australia
 */

use DOMDocument;
libxml_use_internal_errors(true); 

class TextformatterMicrosoftProtectedLinks extends Textformatter implements Module {

	public static function getModuleInfo() {
		return [
			'title' => 'Replace Outlook Protected Links',
			'version' => '101',
			'summary' => 'Replace protected links from Outlook/Teams/Microsoft Office with the original link.',
			'author' => 'Australian Antarctic Division',
			'icon' => 'link',
		];
	}

	public function format(&$str) {
		$dom = new DOMDocument();
		if ($dom->loadHTML('<?xml encoding="utf-8" ?>' . $str, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD) === false) {
			return; // error loading markup from text/textarea field, exit here
		}
		$anchors = $dom->getElementsByTagName('a');

		foreach ($anchors as $anchor) {
			$parsedURL = parse_url($anchor->getAttribute('href'));
			if ($parsedURL === false) {
				continue; // malformed URL, skip
			}

			if (preg_match("/safelinks\.(protection\.outlook|office)\.com$/", $parsedURL['host'])) {
				parse_str($parsedURL['query'], $parsedQuery);
				if (($href = $parsedQuery['url'] ?? '') !== '') {
					$anchor->setAttribute('href', $href);
				}
			}
		}
		$str = str_replace('<?xml encoding="utf-8" ?>', '', $dom->saveHtml());
	}
}