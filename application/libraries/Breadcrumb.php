<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Breadcrumb {
	private $breadcrumbs = array();
	private $separator = '<i class="fa fa-angle-double-right"></i>';
	private $start = '<div id="breadcrumb">';
	private $end = '</div>';

	public function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);
		}		
	}
	
	private function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->{'_' . $key})){
					$this->{'_' . $key} = $val;
				}
			}
		}
	}

	function add($title, $href){		
		if (!$title OR !$href) return;
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	
	function output(){

		if ($this->breadcrumbs) {
			
			$output = $this->start;

			foreach ($this->breadcrumbs as $key => $crumb) {
				if ($key){ 
					$output .= $this->separator;
				}

				if (end(array_keys($this->breadcrumbs)) == $key) {
					$output .= '<span style="font-size:13px;">' . $crumb['title'] . '</span>';			
				} else {
					$output .= '<a style="color:#18ba9b; font-weight:bold;" href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
				}
			}
		
			return $output . $this->end . PHP_EOL;
		}
		
		return '';
	}

}