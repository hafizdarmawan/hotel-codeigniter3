const flashData = $('.flash-data').data('flashdata');

if (flashData) {
	Swal({
		title: 'Data',
		text: 'Berhasil ' + flashData,
		type: 'success'
	});
}

const Gagal = $('.gagal-data').data('flashdata');
if (Gagal) {
	Swal({
		title: 'Gagal!',
		text: 'Terdapat artikel yang menggunakan kategori ini',
		icon: 'error',
		showConfirmButton: false,
		timer: 2000
	})
}

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal({
		title: 'Apakah anda yakin',
		text: "data akan dihapus",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});
