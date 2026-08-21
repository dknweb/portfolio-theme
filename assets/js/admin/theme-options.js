document.addEventListener('DOMContentLoaded', () => {
	const selectButton = document.querySelector('#portfolio-theme-select-resume');
	const removeButton = document.querySelector('#portfolio-theme-remove-resume');
	const resumeId = document.querySelector('#portfolio-theme-resume-id');
	const resumeUrl = document.querySelector('#portfolio-theme-resume-url');

	if (!selectButton || !removeButton || !resumeId || !resumeUrl) {
		return;
	}

	let mediaFrame;

	selectButton.addEventListener('click', (event) => {
		event.preventDefault();

		if (mediaFrame) {
			mediaFrame.open();
			return;
		}

		mediaFrame = wp.media({
			title: 'Select Resume PDF',
			button: {
				text: 'Use this PDF',
			},
			library: {
				type: 'application/pdf',
			},
			multiple: false,
		});

		mediaFrame.on('select', () => {
			const attachment = mediaFrame
				.state()
				.get('selection')
				.first()
				.toJSON();

			resumeId.value = attachment.id;
			resumeUrl.value = attachment.url;

			removeButton.hidden = false;
		});

		mediaFrame.open();
	});

	removeButton.addEventListener('click', (event) => {
		event.preventDefault();

		resumeId.value = '';
		resumeUrl.value = '';

		removeButton.hidden = true;
	});
});