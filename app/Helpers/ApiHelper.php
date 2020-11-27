<?php

if (!function_exists('apigroups')) {
	function apigroups() {
		return config('api.groups');
	}

}

if (!function_exists('apipermissions')) {
	function apipermissions($role = "Joueur", $flat = false) {
		$groups = apigroups();
		$permissions = array();
		foreach ($groups as $group) {
			if ($flat) {
				$permissions = array_merge($permissions, config("api.".$group.".".$role));
			} else {
				$permissions[$group] = config("api.".$group.".".$role);
			}
		}
		return $permissions;
	}
}

if (!function_exists('apican')) {
	function apican($role, $ability) {
		in_array($ability, apipermissions($role, true));
	}
}