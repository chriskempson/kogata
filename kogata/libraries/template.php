<?php
/**
 * Template Library
 *
 * Simple but functional templating class
 * 
 * @package Kogata <https://github.com/ChrisKempson/Kogata>
 * @author Chris Kempson <http://chriskempson.com>
 */
class Template {
	
	var $path;
	
	/**
	 * Constructor
	 *
	 * Optionally takes arguments to be passed to Render
	 *
	 * @param string $template 
	 * @param string $vars 
	 */
	public function __construct($template = null, $vars = null) {
		$this->path = (defined('views_path') ? views_path : 'app/views');
		if ($template) echo $this->render($template, $vars);
	}
	
	/**
	 * Render
	 *
	 * Parses a view file with supplied data
	 *
	 * @param string $template Name of the template
	 * @param string $vars Variables passed to the template
	 * @return void
	 */
	public function render($template, $vars = null) {
		ob_start();
		if ($vars) extract($vars);
		require($this->path.'/'.$template.'.html');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}
?>