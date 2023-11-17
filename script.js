$(document).ready(() => {
	$('.hide').click(function () {
		var del_id = $(this).attr('id');
		var ele = $(this).parent().parent();
		console.log(del_id);
		Swal.fire({
			title: 'Czy na pewno chcesz usunąć wiersz?',
			text: 'Tej operacji nie można cofnąć!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Tak, usuń to!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: 'script.php',
					data: {
						'id': del_id,
						'kategoria': "Usunpost"
					},
					success: function (response) {
						if (response == 1) {
							ele.css('background', 'tomato');
							ele.fadeOut(800, function () {
								$(this).remove();
							});
						} else {
							Swal.fire(
								'Błąd!',
								'Wystąpił problem podczas usuwania.',
								'error'
							);
						}
					}
				});
			}
		});
	});
});