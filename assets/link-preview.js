jQuery(document).ready(function ($) {
    var cachedPreviews = {};
    var exclusions = [
        link_preview_vars.excluded_elements,
        link_preview_vars.excluded_classes,
        link_preview_vars.excluded_ids,
    ];
    exclusions = exclusions.filter(function (exclusion) {
        return exclusion.trim() !== "";
    });
    var combinedExclusions = exclusions.map(function (exclusion) {
        return exclusion.split(", ").map(function (item) {
            return item.trim() + " a";
        }).join(", ");
    }).join(", ");
    var $links = $('#content, #main-content, .content-wrap, .entry-content a:not(:has(img))');
    if (combinedExclusions !== "") {
        $links = $links.not(combinedExclusions);
    }

        $links.on("mouseenter", function () {
        var link = $(this).attr('href');

        if (cachedPreviews[link]) {
            showPreview(cachedPreviews[link], this);
        } else {
            var mshotsURL = link_preview_vars.mshots_url + encodeURIComponent(link) + '?w=' + link_preview_vars.width + '&r=2';
            var previewHTML = '<div class="on-hover-link-prev"><img src="' + mshotsURL + '" alt="OnHover Link Preview" /></div';
            $('body').append(previewHTML);
            var topPosition = $(this).offset().top + $(this).outerHeight() + 5; // Add 5 pixels
            var $preview = $('.on-hover-link-prev');

            $preview.css({
                'position': 'absolute',
                'top': topPosition + 'px',
                'left': $(this).offset().left + 'px',
                'background-color': '#fff',
                'padding': '10px',
                'box-shadow': '0 0 10px rgba(0, 0, 0, 0.2)',
                'z-index': '9999',
                'max-width': '50%'
            });
            cachedPreviews[link] = $preview[0].outerHTML;
        }
    }).on("mouseleave", function () {
        $('.on-hover-link-prev').remove();
    });
    function showPreview(cachedPreview, linkElement) {
        var topPosition = $(linkElement).offset().top + $(linkElement).outerHeight() + 5; // Add 5 pixels
        var $preview = $(cachedPreview);

        $preview.css({
            'position': 'absolute',
            'top': topPosition + 'px',
            'left': $(linkElement).offset().left + 'px',
            'z-index': '9999'
        });
        $('body').append($preview);
    }
});
