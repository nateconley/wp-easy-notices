/**
 * Removes the notice bar
 * Fades up
 */
export default (notice, height, bodyOffsetBottom, bodyOffsetTop) => {

	if (notice.classList.contains('bottom-fixed')) {
		document.body.style.marginBottom = `${ bodyOffsetBottom }px`;
		notice.style.transform = `translate(50%, ${ height }px)`;
	} else {
		document.body.style.marginTop = `${ bodyOffsetTop }px`;
		notice.style.transform = `translate(50%, -${ height }px)`;
	}

	// Set localStorage so that this notice does not show up again
	if (!window.WP_EASY_NOTICES_VARS.is_customizer) {
		window.localStorage.setItem('wp-easy-notices-hidden', window.WP_EASY_NOTICES_VARS.dismissal_cache);
	}

	// Wait 300ms before removing, so transition can run
	window.setTimeout(() => {
		notice.parentNode.removeChild(notice);
	}, 500);

}
