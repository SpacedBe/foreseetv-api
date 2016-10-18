$(document).ready(function () {
    $('.modal-trigger').leanModal();

    $('.js-delete').on('click', (e) => {
        if (!confirm('you sure?')) {
            e.preventDefault();
        }
    });

    $('.tooltip-image').tooltipster();

    $('.tooltip-video').tooltipster({
        theme: 'tooltipster-noir',
        content: 'Loading...',
        contentAsHTML: true,
        interactive: true,
        // 'instance' is basically the tooltip. More details in the "Object-oriented Tooltipster" section.
        functionBefore: function(instance, helper) {
            var $origin = $(helper.origin);
            var videoId = $origin.data('tooltip');

            console.log(videoId);

            instance.content(`<iframe id="ytplayer" type="text/html" width="640" height="390"
  src="https://www.youtube.com/embed/${videoId}?autoplay=1&origin=http://example.com"
  frameborder="0"></iframe>`);
        }
    });
});


