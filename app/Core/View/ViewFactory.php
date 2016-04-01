<?php

namespace App\Core\View;

use \Exception;

class ViewFactory {
	protected $location;

	protected $sections;

	protected $extends;

	public function __construct($location) {
		$this->locator = new ViewLocator();
		$this->location = $location;
	}

	public function extend($location) {
		$this->extends = $location;
	}

	public function yieldSection($section) {
		if (isset($this->sections[$section])) {
			echo($this->sections[$section]);
		}
	}

	public function startSection($section) {
		if (ob_start()) {
            $this->sections[] = $section;
        }
	}

	public function stopSection() {
		if (empty($this->sections)) {
			return;	
		}

		$last = array_pop($this->sections);

		$this->sections[$last] = ob_get_clean();
		
		return $last;
	}

	public function incl($location) {
		include $this->locator->find($this->location);
	}

	public function getLocation() {
		return $this->locator->find($this->location);
	}

	public function getParent() {
		return $this->locator->find($this->extends);
	}

	public static function render($view) {
		require __projectRoot__ . "/helpers/viewFunctions.php";

		$location = $view->getLocation();
		if (file_exists($location)) {
			require $location;

			if (isset($view->extends)) {
				require $view->getParent();
			}
		 	return;
		}
		throw new Exception("View not found", 1);
	}
}
