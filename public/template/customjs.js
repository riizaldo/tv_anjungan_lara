// scrollContent.style.animationDuration = '15s';
scrollContent1.style.animationDuration = frame1 + "s";
scrollContent2.style.animationDuration = frame2 + "s";
running_textfooter.style.animationDuration = footer + "s";

document.addEventListener("DOMContentLoaded", function () {
    var carouselElement = document.querySelector("#carouselExample");
    var carousel = new bootstrap.Carousel(carouselElement, {
        interval: carouselInterval, // Set interval to 5 seconds
        ride: "carousel",
    });
});

function fetchAndUpdateData() {
    $.ajax({
        url: "{{ url('/') }}/get-kegiatan-univ",
        method: "GET",
        success: function (data) {
            $("#categoryTable1").empty();

            data.forEach(function (ku, index) {
                var colors = ["#134f5c", "#38761d"];
                var backgroundColor = colors[index % colors.length];

                $("#categoryTable1").append(
                    '<li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px; background-color: ' +
                        backgroundColor +
                        ';">' +
                        ku.kegiatan +
                        " | " +
                        new Date(ku.start_date).toLocaleString("en-GB", {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                        }) +
                        " - " +
                        new Date(ku.end_date).toLocaleString("en-GB", {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                        }) +
                        " | " +
                        ku.keterangan +
                        "</li>"
                );
            });
        },
        error: function (xhr) {
            console.error("Error fetching data:", xhr);
        },
    });
}

function fetchAndUpdateData2() {
    $.ajax({
        url: "{{ url('/') }}/get-kegiatan-fak",
        method: "GET",
        success: function (data) {
            $("#categoryTable2").empty();

            data.forEach(function (ku, index) {
                var colors = ["#134f5c", "#38761d"];
                var backgroundColor = colors[index % colors.length];

                $("#categoryTable2").append(
                    '<li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px; background-color: ' +
                        backgroundColor +
                        ';">' +
                        ku.kegiatan +
                        " | " +
                        new Date(ku.start_date).toLocaleString("en-GB", {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                        }) +
                        " - " +
                        new Date(ku.end_date).toLocaleString("en-GB", {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                        }) +
                        " | " +
                        ku.keterangan +
                        "</li>"
                );
            });
        },
        error: function (xhr) {
            console.error("Error fetching data:", xhr);
        },
    });
}
