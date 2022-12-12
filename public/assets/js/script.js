const toggleSidebar = () => document.body.classList.toggle("open");

$(function() {
    $('#datetimepicker1').datetimepicker();
});

// location
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    }
}

function showPosition(position) {
    document.querySelector('.myForm input[name="latitude"]').value =
        position.coords.latitude;
    document.querySelector('.myForm input[name="longitude"]').value =
        position.coords.longitude;
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Anda harus mengaktifkan lokasi saat ini!");
            location.reload();
            break;
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function load() {

    var date_format = function () {
        var hari = new Date()
        var jam = hari.getHours() + ":" + hari.getMinutes()
        return (jam)
    }

    $.ajax({
        url: '/admin',
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            $('#data').html('')
            $.each(data, function (key, val) {

                var tanggal = new Date(val.created_at);
                const yyyy = tanggal.getFullYear();
                let mm = tanggal.getMonth() + 1; // Months start at 0!
                let dd = tanggal.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;
                const formattedToday = dd + '/' + mm + '/' + yyyy;

                $('#data').append(
                    "<tr>" +
                    "<td>" +
                    "<p>" + formattedToday + "</p>" +
                    "</td>" +
                    "<td>" +
                    "<div class='d-flex align-items-center'>" +
                    "<div class='ms-3 >" +
                    "<p class='fw-bold mb-0' style='width:150px'>" + val.nama_lengkap + "</p>" +
                    "<i class='fab fa-whatsapp text-primary'></i>" +
                    "<a href='https://wa.me/" + val.user.no_telp + "' target='_blank'> Hubungi Teknisi</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<p>" + val.atm.kode_mesin + "</p>" +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<p>" + val.atm.nama_atm + "</p>" +
                    "<div style='width: 180; height: 180;'>" +
                    "<iframe src='https://www.google.com/maps?q=" + val.latitude + "," + val.longitude + "&hl=es;z=14&output=embed' frameborder='0'>" + "</iframe>" +
                    "</div>" +
                    "</td>" +
                    "<td>" +
                    val.keterangan +
                    "</td>" +
                    "<td class='text-center'>" +
                    "<img src='storage/uploads/" + val.foto + "' class='rounded' alt='' style='width:100px; height:100px'/>" +
                    "<a href='#'data-id='" + val.id + "' bs-toggle='modal' data-bs-target='#showImage' class='lihat-gambar'>Lihat Gambar</a>" +
                    "</td>" +
                    "<td style='width:200px' class='text-center'>" +
                    (val.kondisi_mesin == 'Menunggu Tindakan' ? '<button type="button" class="btn btn-warning btn-rounded mb-2">Perlu Tindakan</button>' : val.kondisi_mesin == 'Selesai' ? '<button type="button" class="btn btn-success btn-rounded mb-2">SELESAI</button>' : '') +
                    "<a href='#' data-id=" + val.id + " class='ubah-status'>Ubah status</a>" +
                    "</td>" +
                    "</tr>"
                )
            })
        }
    })
}

$("body").on("click", ".ubah-status", function () {
    var id = $(this).data("id");
    var kondisi_mesin = $(this).data("kondisi_mesin");
    $.ajax({
        url: "admin/" + id + "/ubahstatus",
        type: "GET",
        success: function (data) {
            $("#ubahStatus").modal("show");
            $("#id").val(data.result.id);
            $("#kondisi_mesin").val(data.result.kondisi_mesin);
            $(".tombol-update").click(function () {
                update(id);
                load()
            });
            $('.close').on('click', function () {
                $('#ubahStatus').modal('hide');
            })
        },
    });
});

function update(id) {
    $.ajax({
        url: "admin/updatestatus/" + id,
        type: "POST",
        data: {
            kondisi_mesin: $("#kondisi_mesin").val(),
        },
        success: function (data) {
            if (data.errors) {
                // console.log("error");
            } else {
                // console.log("success");
                $("#ubahStatus").modal("hide");
            }
        },
    });
}

$(document).ready(function () {
    load()
    $("body").on("click", ".lihat-gambar", function () {
        var id = $(this).attr("data-id");
        var url = "admin/showimage/" + id;

        if (id > 0) {
            url.replace("id", id);

            $("#resultImage").empty();

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    $("#resultImage").html(result.html);
                    $("#showImage").modal("show");
                    $('.close').on('click', function () {
                        $('#showImage').modal('hide');
                    })
                }
            });
        }
    });
});

$('#nip_teknisi').on('change', function () {
    $('#nama_lengkap').val($(this).val())
})

$('#nip_teknisi').change()


