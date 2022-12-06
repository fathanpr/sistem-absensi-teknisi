const toggleSidebar = () => document.body.classList.toggle("open");

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

// GLOBAL SETUP
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

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
            console.log(data.result);
            $(".tombol-update").click(function () {
                update(id);
            });
        },
    });
    $("#ubahStatus").modal("hide");
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
                console.log("error");
            } else {
                console.log("success");
                $("#ubahStatus").modal("hide");
            }
        },
    });
}

$(document).ready(function () {
    $("body").on("click", ".lihat-gambar", function () {
        var id = $(this).attr("data-id");

        console.log(id);

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
                },
            });
            $("#showImage").modal("hide");
        }
    });
});
