<?php
namespace JasonXt\UmengLaravel\IOS;

class IOSBroadcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}