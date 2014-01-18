<?php

class CommentHelper {
	public static function getWorkloadOptions() {
		return array(
			'1' => Lang::get('app.workload_1'),
			'2' => Lang::get('app.workload_2'),
			'3' => Lang::get('app.workload_3'),
			'4' => Lang::get('app.workload_4'),
			'5' => Lang::get('app.workload_5'),
		);
	}

	public static function getWorkloadText($index) {
		$workloads = static::getWorkloadOptions();
		return $workloads[$index];
	}
}