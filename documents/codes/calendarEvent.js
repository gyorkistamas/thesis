events: function (info, successCallback, failureCallback) {
	$wire.getEvents(info.startStr, info.endStr).then(value => {
		successCallback(JSON.parse(value));
	})
	.catch(err => {
		failureCallback(err);
	});
}