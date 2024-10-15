function file_manager(id, type, multi_selection, options) {
    let $button = $("#" + id);

    $button.on("click", function () {
        var route_prefix =
            options && options.prefix ? options.prefix : "/filemanager";
        var $target_input = $("#" + $button.data("input"));
        var $target_preview = $("#" + $button.data("preview"));



        window.open(
            route_prefix +
                ("?type=" + type || "image") +
                ("&multi_selection=" + multi_selection || "image"),
            "FileManager",
            "width=900,height=600"
        );

        window.SetUrl = function (items) {
            var file_path = items
                .map(function (item) {
                    return item.url;
                })
                .join(",");

            // set the value of the desired input to image url
            $target_input.val(file_path).trigger("change");

            // clear previous preview
            $target_preview.html("");

            $target_preview.addClass("mr-3");

            // set or change the preview image src
            items.forEach(function (item) {
                let img = $("<img>")
                    .css("width", "200px")
                    .css("height", "130px")
                    .addClass('mr-3')
                    .attr("src", item.thumb_url);
                $target_preview.append(img);
            });

            // trigger change event
            $target_preview.trigger("change");
        };
    });
}
