;(function () {
	/**
	 * Run function when customizer is ready.
	 */
	wp.customize.bind('ready', function () {
		wp.customize.control('hesta_slider_layout', function (control) {
			/**
			 * Run function on setting change of control.
			 */
			control.setting.bind(function (value) {
				switch (value) {
					/**
					 * The select was switched to the hide option.
					 */
					case 'post':
						/**
						 * Deactivate the conditional control.
						 */
						wp.customize.control('hesta_post_1').activate();
						wp.customize.control('hesta_post_2').activate();
						wp.customize.control('hesta_post_3').activate();
						wp.customize.control('hesta_page_1').deactivate();
						wp.customize.control('hesta_page_2').deactivate();
						wp.customize.control('hesta_page_3').deactivate();
						break;
					/**
					 * The select was switched to »show«.
					 */
					case 'page':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('hesta_page_1').activate();
						wp.customize.control('hesta_page_2').activate();
						wp.customize.control('hesta_page_3').activate();
						wp.customize.control('hesta_post_1').deactivate();
						wp.customize.control('hesta_post_2').deactivate();
						wp.customize.control('hesta_post_3').deactivate();
						break;
						
					default:
						wp.customize.control('hesta_page_1').deactivate();
						wp.customize.control('hesta_page_2').deactivate();
						wp.customize.control('hesta_page_3').deactivate();
						wp.customize.control('hesta_post_1').deactivate();
						wp.customize.control('hesta_post_2').deactivate();
						wp.customize.control('hesta_post_3').deactivate();
				}
			});
		});
	});
})();