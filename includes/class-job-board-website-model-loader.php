<?php

class Job_Board_Website_Model_Loader
{
	/**
	 * Require the table models.
	 *
	 * @return void
	 */
	public static function setup_models(): void
	{
		$models_directory = plugin_dir_path( dirname( __FILE__ ) ) . 'includes/models';
		$model_files = glob($models_directory . '/*.php');

		foreach ( $model_files as $file ) {
			require_once $file;
		}
	}
}
