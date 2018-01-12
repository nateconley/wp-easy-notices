// Import scss
import './sass/index.scss';

// Import modules
import checkForDismissal from './modules/checkForDismissal';
import removeNotice from './modules/removeNotice';

(function() {

	const noticeBar = document.getElementById('wp-easy-notices');
	const dismissed = checkForDismissal();

	// If this is already dismissed, remove it immediately and return
	if (dismissed) {
		noticeBar.parentNode.removeChild(noticeBar);
		return;
	}

	// If there is no noticeBar, return
	if (!noticeBar) {
		return;
	}

	noticeBar.style.display = 'block';

	// Get the height of the admin bar
	const height = Number(noticeBar.offsetHeight);

	// See if there is currently any body offset
	const bodyOffsetBottom = Number(getComputedStyle(document.body)['margin-bottom'].split(/[a-z]/)[0]);
	const bodyOffsetTop = Number(getComputedStyle(document.body)['margin-top'].split(/[a-z]/)[0]);

	if (noticeBar.classList.contains('bottom-fixed')) {
		document.body.style.marginBottom = `${ height + bodyOffsetBottom }px`;
	} else {
		document.body.style.marginTop = `${ height + bodyOffsetTop }px`;
	}

	// The 'dismiss' button
	const noticeDismiss = document.querySelector('#wp-easy-notices .dismiss');

	if (noticeDismiss) {

		// Listen for clicks on the 'dismiss' button
		noticeDismiss.addEventListener('click', () => {
			removeNotice(noticeBar, height, bodyOffsetBottom, bodyOffsetTop)
		});

	}
})();
