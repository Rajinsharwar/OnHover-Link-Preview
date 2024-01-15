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
    var $links = $('#content a:link, #main-content a:link, .content-wrap a:link, .entry-content a:link, article a:not(:has(img))');
    if (combinedExclusions !== "") {
        $links = $links.not(combinedExclusions);
    }

    // Preload previews on page load
    $links.each(function () {
        var link = $(this).attr('href');
        preloadPreview(link);
    });

    $links.on("mouseenter", function () {
        var link = $(this).attr('href');

        if (cachedPreviews[link]) {
            showPreview(cachedPreviews[link], this);
        } else {
            // Load and cache the preview
            preloadPreview(link);
        }
    }).on("mouseleave", function () {
        $('.on-hover-link-prev').remove();
    });

    function preloadPreview(link) {
        var mshotsURL = link_preview_vars.mshots_url + encodeURIComponent(link) + '?w=' + link_preview_vars.width + '&r=2';
        var previewHTML = '<div class="on-hover-link-prev"><img src="' + mshotsURL + '" alt="OnHover Link Preview" /></div';
        cachedPreviews[link] = previewHTML;
    }

    function showPreview(cachedPreview, linkElement) {
        var topPosition = $(linkElement).offset().top + $(linkElement).outerHeight() + 5; // Add 5 pixels
        var $preview = $(cachedPreview);

        $preview.css({
            'position': 'absolute',
            'top': topPosition + 'px',
            'left': $(linkElement).offset().left + 'px',
            'background-color': '#fff',
            'padding': '10px',
            'box-shadow': '0 0 10px rgba(0, 0, 0, 0.2)',
            'z-index': '9999',
            'max-width': '50%'
        });
        $('body').append($preview);
    }
});
