(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .filter('secondsToFormattedHour', SecondsToFormattedHourFilter);

	function SecondsToFormattedHourFilter() {
		return formatSeconds;
	}

	function formatSeconds(seconds) {
		if (seconds) {
			var hours = Math.floor(seconds / 3600);
			seconds = seconds % 3600;
			var minutes = Math.floor(seconds / 60);
			seconds = seconds % 60;

			return lpad(hours,2) + ":" + lpad(minutes,2) + ":" + lpad(seconds,2);
		
		}
		
		return "00:00:00";
	}

	function lpad(number, digits) {
		return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
	}

})();