var Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});

function setBtnLoading(element, text, status = true) {
	const el = $(element);
	if (status) {
		el.attr("disabled", "");
		el.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${text}`);
	} else {
		el.removeAttr("disabled");
		el.html(text);
	}
}