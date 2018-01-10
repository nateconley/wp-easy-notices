/**
 * When the button to clear dismissals is pressed, fire off
 * an ajax request to set the option to the current time,
 * in effect clearing a cache
 */
{

	const $ = window.jQuery;

	window.wp.customize.control('wp_easy_notices_clear_dimissals', (control) => {
		control.container.find('.button').on('click', function() {
			const button = $(this);
			button.addClass('disabled');
			$.post(ajaxurl, {
				action: 'wp_easy_notices_clear_dimissals',
			})
			.done(function() {
				button.removeClass('disabled');
			});
		});
	});

	// Toggle dismissal-specific fields
	window.wp.customize.control('wp_easy_notices_dismissable', (control) => {
		toggleFields(control.setting.get());
		const radio = control.container.find('input[type="radio"]');
		radio.on('click', function() {
			toggleFields($(this).val());
		});
	});

	function toggleFields(value) {
		window.wp.customize.control('wp_easy_notices_dismiss_icon', (control) => {
			if (value === 'persistent') {
				$(control.container).hide();
			} else {
				$(control.container).show();
			}
		});
		window.wp.customize.control('wp_easy_notices_clear_dimissals', (control) => {
			if (value === 'persistent') {
				$(control.container).hide();
			} else {
				$(control.container).show();
			}
		});
	}

}
