/**
 * Check localStorage and the dismissal cache to see if
 * this should be a dismissed notice
 *
 * Return true for dismissed, false for display
 */
export default () => {
	const dismissed = window.localStorage.getItem('wp-easy-notices-hidden');

	if (!dismissed) {
		return false;
	}

	// Don't dismiss for the customizer
	if (window.WP_EASY_NOTICES_VARS.is_customizer) {
		return false;
	}

	if (window.WP_EASY_NOTICES_VARS.dismissable &&
		dismissed === window.WP_EASY_NOTICES_VARS.dismissal_cache) {
		return true;
	}

	return false;
}
