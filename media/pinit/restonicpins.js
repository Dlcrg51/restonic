jQuery(document).ready(function($) {

    var blog = $('.itemFullText img');

    var mattresses = $('.mattress-item-image img');

    var toolbar = $('.share-item');

    addPinit(blog);
    pinMattress(mattresses);
    // buildImageShareToolbar(toolbar);

    function pinMattress(mattressSelector)
    {
        mattressSelector.each(function() {
            var pinurl      = encodeURIComponent(_pinurl); // we get the global
            var pinmedia    = encodeURIComponent(window.location.origin + $(this).attr('src')); // we get this from global
            var alt         = encodeURIComponent($(this).attr('alt'));
            var pinterstBrand   = '//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png';

            // get the image float
            var float = $(this).css("float");

            // get the image styling so we can add it to the toolbar
            var width = 'width:' + $(this).attr('width') + 'px;';
            var style = $(this).attr('style');

            // determine our position
            var position = getPosition(float);

            // wrap the image in a div so we can float it
            $(this).wrap('<div class="share-item ' + position + '"></div>');

            var pinterest   = buildPinitButton(pinurl, pinmedia, alt, pinterstBrand);

            // build the final share markup
            var shareMarkup = '<div class="pinit-btn">';

            // get the pin markup
            shareMarkup += pinterest;

            // close link
            shareMarkup += '</div>';

            // prepend before the image
            $(this).before(shareMarkup);

        });
    }

    /*
     * main function. loops through the selectors and adds the necessary JS.
     */
    function addPinit(selector) {

        selector.each(function () {

            // if the image is less than 150px in width skip execution
            if ($(this).attr('width') < 150)
            {
                return;
            }

            // get the image float
            var float = $(this).css("float");

            // get the image styling so we can add it to the toolbar
            var width = 'width:' + $(this).attr('width') + 'px;';
            var style = $(this).attr('style');

            // determine our position
            var position = getPosition(float);

            // wrap the image in a div so we can float it
            $(this).wrap('<div class="share-item ' + position + '" style="max-width:' + $(this).attr('width') + 'px;' + style + '"></div>');

            // get root path
            if (!window.location.origin)
                window.location.origin = window.location.protocol + "//" + window.location.host;

            // get pin media info
            var pinurl      = encodeURIComponent(_pinurl); // we get the global
            var pinmedia    = encodeURIComponent(window.location.origin + $(this).attr('src')); // we get this from global
            var alt         = encodeURIComponent($(this).attr('alt'));

            var pinterstBrand   = '//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png';
            var restonicPin     = '/images/social-icons/pinterest.png';

            var pinButton   = buildPinitButton(pinurl, pinmedia, alt, pinterstBrand);
            var pinterest   = buildPinitButton(pinurl, pinmedia, alt, restonicPin);
            var facebook    = buildFacebookShare(pinurl, pinmedia, alt);
            var tumblr      = buildTumblrButton(pinurl, pinmedia, alt);
            var twitter     = buildTwitterButton(pinurl);
            var google      = buildGoogleButton(pinurl);

            // build the final share markup
            var shareMarkup = '<div class="pinit-btn">';

            // get the pin markup
            shareMarkup += pinButton;

            // close link
            shareMarkup += '</div>';

            toolbar = buildImageShareToolbar(pinterest, facebook, twitter, tumblr, google, width);

            // prepend before the image
            $(this).before(shareMarkup);


            $(this).before(toolbar);

            // on hover in out show / hide the toolbar
            $('.share-item').hover(function(){
                $('.image-share-toolbar', $(this)).removeClass('hidden');
            }, function(){
                $('.image-share-toolbar', $(this)).addClass('hidden');
            });


        }); // end each

    } // end addpinit

    /*
     * Float our image container div as needed. Gets this from the image style.
     */

    function executePinit()
    {
        // execute pinit after we're done with our markup
        (function (d) {
            var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
            p.type = 'text/javascript';
            p.async = true;
            p.src = '//assets.pinterest.com/js/pinit.js';
            f.parentNode.insertBefore(p, f);
        }(document));
    }

    function getPosition(float)
    {
        var position = 'share-img-';

        // determine our float for the container div
        if (float == 'left' || float == 'right') {
            // if our position is right or left add it
            position += float;
        }
        else {
            // no position specified so default to left
            position += 'left';
        }

        return position;
    }

    function buildImageShareToolbar(pinterest, facebook, twitter, tumblr, google, style)
    {
        var shareToolbar = '<div class="image-share-toolbar hidden" style="width:100%">';

        shareToolbar += pinterest + twitter + tumblr + google + facebook;

        shareToolbar += '</div>';

        return shareToolbar;
    }

    function buildFacebookShare(link, image, description)
    {
        var facebookImage  = '<img src="/images/social-icons/facebook.png" />';
        var facebookLink = '';

        facebookLink += 'https://www.facebook.com/dialog/feed?';
        facebookLink += 'app_id=758524240891668';
        facebookLink += '&display=popup';
        facebookLink += '&picture='       + image;
        facebookLink += '&href='          + link;
        facebookLink += '&redirect_uri='  + link;
        facebookLink += '&name='          + $("meta[property='og:title']").attr("content");
        facebookLink += '&description='   + $("meta[property='og:description']").attr("content");

        var facebookMarkup = '<a href="' + facebookLink + '" onclick="window.open(this.href, \'facebook-share-dialog\', \'width=626,height=436\'); return false;">' + facebookImage + '</a>';

        return facebookMarkup;
    }

    /*
     * Create a pinterest share button markup.
     */
    function buildPinitButton(link, image, description, pinimg)
    {
        var pinitMarkup = '<a href="http://www.pinterest.com/pin/create/button?';

        // add url params
        pinitMarkup += 'url=' + link;
        pinitMarkup += '&media=' + image;
        pinitMarkup += '&description=' + description;

        pinitMarkup += '"'; // close href
        pinitMarkup += "onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=780');return false;\"";

        // additional href options
        pinitMarkup += 'data-pin-do="buttonPin" data-pin-config="none">';

        // insert image
        pinitMarkup += '<img src="' + pinimg + '" />';

        // close link
        pinitMarkup += '</a>';

        return pinitMarkup;
    }

    function buildTwitterButton(link)
    {
        var twitterImage   =  '<img src="/images/social-icons/twitter.png" />';

        var twitterMarkup  =  '<a href="https://twitter.com/intent/tweet?';
        twitterMarkup      += 'text=' + $.trim($('.itemTitle').text());
        twitterMarkup      += '&url='  +  link;
        twitterMarkup      += '&hashtags=sleepBlog';
        twitterMarkup      += '&via=restonicbeds';

        twitterMarkup      += '">' + twitterImage +'</a>';

        return twitterMarkup;
    }

    function buildTumblrButton(link, image, description)
    {
        var tumblrImage  =  '<img src="/images/social-icons/tumblr.png" />';
        var tumblrMarkup =  '<a href="http://www.tumblr.com/share/photo?';
        tumblrMarkup     += 'source='       + image;
        tumblrMarkup     += '&caption='     + description;
        tumblrMarkup     += '&clickthru='   + link;
        tumblrMarkup     += '" title="Share on Tumblr">'; // close the open link markup
        tumblrMarkup     += tumblrImage + '</a>'; // add image and close link

        return tumblrMarkup;
    }

    function buildGoogleButton(link)
    {
        var googleImage     = '<img src="/images/social-icons/googleplus.png" />';
        var googleMarkup    = '<a href="https://plus.google.com/share?';

        googleMarkup        += 'url=' + link + '"';
        googleMarkup        += "onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">";
        googleMarkup        += googleImage + '</a>';

        return googleMarkup;
    }
});