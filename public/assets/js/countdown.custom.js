function Countdown(options) {
	function countdowner() {
		remaining -= 1;

		var percentage = (duration - remaining) / (duration / 100.0);

		var text = '';
		if (remaining < 60) {
			text = remaining;
		} else if (remaining < 60 * 60) {
			text = moment.utc(remaining * 1000).format("m:s");
		} else {
			text = moment.utc(remaining * 1000).format("H:m:s");
		}

		if (remaining == 0) {
			clearInterval(interval);
			setTimeout(countdownCallback, reloadCallbackDelay * 1000);
			text = 'DONE'
		}

		if (progressBar) {
			progressBar.animate(percentage / 100);
			progressBar.setText(text);
		}

		if (bottomProgress) {
			document.getElementById(bottomProgress).style.width = percentage + '%';
		}
	}

	var progressBar = false;
	var remaining = 0;
	var duration = 0;
	var reloadCallbackDelay = 2;
	var bottomProgress = false;
	var countdownCallback = function() {
		location.reload();
	}

	if (options.countdownCallback) countdownCallback = options.countdownCallback;
	if (options.reloadCallbackDelay) reloadCallbackDelay = options.reloadCallbackDelay;
	if (options.remaining) remaining = options.remaining;
	if (options.duration) duration = options.duration;
	if (options.progressBar) progressBar = options.progressBar;
	if (options.bottomProgress) bottomProgress = options.bottomProgress;

	countdowner();
	var interval = setInterval(countdowner, 1000);
}