$(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
        var timestamp = $("#lastPostTime").text();
        $.get({
            url: "/api.php?action=getPost&time="+timestamp,
            success: function (result) {
                var time = $($.parseHTML(result)).filter("#latest");
                $("#lastPostTime").text(time.text());
                $("#feed").append(result).fadeIn(100);
                $("#latest").remove();
            }
        });
    }
});