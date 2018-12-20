<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Category;

class AdminSettingsController extends AdminController {

	/**
	 * Display settings page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( 'pages.admin.settings', array(
			'title'  => __( 'Manage Settings' ),
			'fields' => $this->getSettingsFields(),
		) );
	}

	public function getSettingsFields() {
		return array(
			'ui_show_dashboard_menu' => array(
				'type' => 'checkbox',
				'label' => __( 'Show "Dashboard" Menu Item' ),
			),
		);
	}
}