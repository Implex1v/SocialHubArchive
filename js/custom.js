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

function toggleFilter(channel, element) {
    var name = "filter"+channel;

    if($.cookie(name) !== undefined) {
        if($.cookie(name) === '1') {
            $.cookie(name, '0', { expires: 365 });
            $(element).find("i").addClass("filter-disabled");
            $("#content").load(document.URL + " #content");
        } else {
            $.cookie(name, '1', { expires: 365 });
            $(element).find("i").removeClass("filter-disabled");
            $("#content").load(document.URL + " #content");
        }
    } else {
        $.cookie(name, '1', { expires: 365 });
        $(element).find("i").removeClass("filter-disabled");
    }
}

function initFilterIcons(channel, element) {
    var name = "filter"+channel;

    if($.cookie(name) !== undefined) {
        if($.cookie(name) === '1') {
            $(element).find("i").removeClass("filter-disabled");
        } else {
            $(element).find("i").addClass("filter-disabled");
        }
    } else {
        $.cookie(name, '1', { expires: 365 });
        $(element).find("i").removeClass("filter-disabled");
    }
}

$(document).ready(function () {
    initFilterIcons("Youtube", $("#filterToggleYoutube"));
    initFilterIcons("Twitter", $("#filterToggleTwitter"));
    initFilterIcons("Twitch", $("#filterToggleTwitch"));
    initFilterIcons("Instagram", $("#filterToggleInstagram"));
});