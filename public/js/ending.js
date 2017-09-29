(function ($, undefined) {

    $('.js-accountMarker-toggleDetails').on('click', function () {
        $(this).next().toggle();
    });

})(jQuery);
if (typeof taxes === 'undefined') {
    var taxes = {};
}

(function ($, accounting, taxes, translations, undefined) {

    $(".js-removeProduct").on("click", function (e) {
        e.preventDefault();
        toggleProductButtons($(this).data('product-id'), true);
        updateCart();
    });

    $(".js-addProduct").on("click", function (e) {
        e.preventDefault();
        toggleProductButtons($(this).data('product-id'), false);
        updateCart();
    });

    $(".js-shipping-field").on("change", function (e) {
        updateCart();
    });

    $(".js-cart-shippingAddress").on("change", function (e) {
        updateCart();
    });

    $(".js-cart-shippingAddress").trigger('change');
    
    function toggleProductButtons(productId, showAddButton) {
        if (showAddButton) {
            $('#product' + productId).addClass('cart-productLine-removed');
            $('.js-addProduct[data-product-id=' + productId + ']').show();
            $('.js-removeProduct[data-product-id=' + productId + ']').hide();
            $('.js-productInput[name="product[' + productId + ']"]').val(0);
        } else {
            $('#product' + productId).removeClass('cart-productLine-removed');
            $('.js-addProduct[data-product-id=' + productId + ']').hide();
            $('.js-removeProduct[data-product-id=' + productId + ']').show();
            $('.js-productInput[name="product[' + productId + ']"]').val(1);
        }
    }

    function updateCart() {
        var subtotal = computeCartSubtotal();
        outputCartSubtotal(subtotal);

        var shipping = computeCartShipping();
        outputCartShipping(shipping);

        subtotal += shipping;

        var taxes = computeCartTaxes(subtotal);
        outputCartTaxes(taxes);
        
        var total = computeCartTotal(subtotal, taxes);
        outputCartTotal(total);
        
        if (!$(".js-productInput").filter('[value="1"]').length) {
            $(".js-productInput").eq(0).closest("form").find('*[type="submit"]').prop("disabled", true).addClass('cart-button-disabled');
            $(".js-productInput").eq(0).closest("form").on("submit", function(e){
                e.preventDefault();
            });
            
        } else {
            $(".js-productInput").eq(0).closest("form").find('*[type="submit"]').prop("disabled", false).removeClass('cart-button-disabled');
            $(".js-productInput").eq(0).closest("form").off("submit");
        }
    }

    function computeCartSubtotal() {
        var subtotal = 0;

        $('.js-productLine:not(.cart-productLine-removed)').each(function () {
            subtotal += parseFloat($(this).find('.js-cart-price').data('price').toString().replace(',', '.'));
        });

        return subtotal;
    }

    function outputCartSubtotal(subtotal) {
        $('.js-cart-subtotal').html(formatMoney(subtotal));
    }

    function computeCartShipping() {
        if ($('.js-shipping-field:checked').length > 0) {
            return parseFloat($('.js-cart-shipping').data('price'));
        }

        return shipping_cost;
    }

    function outputCartShipping(shipping) {
        $('.js-cart-shipping').html(formatMoney(shipping));
    }

    function computeCartTaxes(subtotal) {
        var activeTaxes,
            $selectedShippingAddress = $('select[name=shipping_address] option:selected');

        if ($selectedShippingAddress.val()) {
            activeTaxes = $.extend({}, taxes[$selectedShippingAddress.data('province')]);
        }

        for (var key in activeTaxes) {
            activeTaxes[key] = Math.round(activeTaxes[key] * subtotal * 100) / 100;
        }

        return activeTaxes;
    }

    function outputCartTaxes(taxes) {
        var $taxRows = $('.js-cart-taxValue').closest('tr'),
            firstRow = true;

        $taxRows.slice(1).remove();

        $taxRows = $('.js-cart-taxValue').closest('tr');

        for (var key in taxes) {
            if (firstRow) {
                $taxRows.find('.js-cart-taxLabel').html(translations['tax_' + key]);
                $taxRows.find('.js-cart-taxValue').html(formatMoney(taxes[key]));
            } else {
                var $newRow = $taxRows.clone();
                $newRow.find('.js-cart-taxLabel').html(translations['tax_' + key]);
                $newRow.find('.js-cart-taxValue').html(formatMoney(taxes[key]));
                $taxRows.after($newRow);
            }
            firstRow = false;
        }
    }

    function computeCartTotal(subtotal, taxes) {
        var total = 0;

        total += subtotal;

        for (var key in taxes) {
            total += taxes[key];
        }

        return total;
    }

    function outputCartTotal(total) {
        $('.js-cart-total').html(formatMoney(total));
    }

    function formatMoney(value) {
        return accounting.formatMoney(value);
    }

})(jQuery, accounting, taxes, translations);

var scrollTopOffset = 0;

function updateScrollTopOffset() {
    if (true) {
        // HEADER EST FIXED
        scrollTopOffset = $(".navbar").outerHeight();
    } else {
        // HEADER N'EST PAS FIXED
        scrollTopOffset = 0;
    }
}

// function updateLogoSize() {
//     if (getScrollTop() > 0) {
//         $(".navbar-brand").addClass("navbar-brand-smaller");
//     } else {
//         $(".navbar-brand").removeClass("navbar-brand-smaller");
//     }
// }

function doEventPeriodically($target, _event, interval, callback) {
    var timeout;
    var timestamp = false;
    
    $target.on(_event, function(){
        clearTimeout(timeout);
        
        if (timestamp === false) {
            timestamp = Date.now();
        }
        
        if (Date.now() - timestamp >= interval) {
            _function();
            return;
        }
        
        timeout = window.setTimeout(_function, interval);
    });
    
    function _function() {
        timestamp = false;
        callback();
    }
}

function updateFileInputPhoto(input) {
    var $photo = $($(input).data("photo"));
    
    if ($photo.length) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $photo.attr("src", e.target.result);
                // $photo.addClass("hasPhoto");
                // $(".question-photoPlaceholder").remove();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
}

function getScrollTop() {
    if (typeof pageYOffset != "undefined") {
        //most browsers except IE before #9
        return pageYOffset;
    } else {
        var B = document.body; //IE "quirks"
        var D = document.documentElement; //IE with doctype
        D = (D.clientHeight)? D: B;
        return D.scrollTop;
    }
}

function scrollToElement(element, options) {
    var options = $.extend({
        offset: 0
    }, options);

    var offset = $(element).offset();
    scrollToPosition(offset.top + parseInt(options.offset), options);
}

function scrollToPosition(top, options){
    // backward compatibility
    if (typeof arguments[1] == "number") {
        options = {speed: arguments[1]};
        if (typeof arguments[2] == "function") {
            options.callback = arguments[2];
        }
    }
    
    top -= scrollTopOffset;

    var options = $.extend({
        speed: 800,
        // easing: "easeInOut",
        callback: function(){}
    }, options);

    var $a = $("body, html").stop().animate({
        scrollTop: top
    }, {
        duration: options.speed/*,
        easing: options.easing*/
    });
    $a.promise().done(options.callback);

    $("body, html").on("mousewheel.stop", function(event) {
        $("body, html").stop();
        $("body, html").off("mousewheel.stop");
    });

    $("body, html").promise().done(function() {
        $("body, html").off("mousewheel.stop");
    });
}

function ajaxFormHandler() {
    var $form = $(this);
    var url = $form.attr("action");
    var type = $form.attr("method");
    var data = $form.serialize();
    
    if (type != "" && url != "") {
        $form.find(".form-field-errored").removeClass("form-field-errored");
        $form.find(".form-error").remove();
        
        $form.off("submit");
        $form.imarcomLoader();
        
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(xhr) {
                $form.trigger("loader.destroy");
                
                if ($form.attr("data-newTitle")) {
                    $("h1").text($form.attr("data-newTitle"));
                }
                
                if ($form.attr("data-redirect")) {
                    window.location = $form.data("redirect");
                    
                } else if ($form.hasClass("question-form-modifying")) {
                    if ($(".question-modifyingFormMessage").length) {
                        url += "?message=" + $(".question-modifyingFormMessage").text();
                    }
                    
                    // Reload the page without the $_GET argument(s)
                    window.location = url;
                    
                } else if (xhr.redirect !== undefined) {
                    var redirect = xhr.redirect;
                    
                    if (xhr.message !== undefined) {
                        redirect += "?message=" + xhr.message;
                    }
                    
                    window.location = redirect;
                    
                } else if ($form.next(".form-success").length) {
                    $form.stop().animate({
                        height: 0
                    }, 500);
                    
                    $form.next(".form-success").show().stop().animate({
                        opacity: 1
                    }, 500);
                    
                } else {
                    alert("Success");
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON;
                
                $.each(errors, function(key, message){
                    var $element = $form.find('*[name="'+key+'"]');
                    var $pref_element = $form.find('*[name="'+ key.replace("preferences.", "preferences[") + "]" +'"]');
                    var $pref_element_array = $form.find('*[name="'+ key.replace("preferences.", "preferences[") + '][]"]');
                    
                    if ($pref_element_array.length) {
                        $pref_element_array = $pref_element_array.eq(0);
                    }
                    
                    var $elements = $element.add($pref_element).add($pref_element_array);
                    var error_outputed = false;
                    
                    if ($elements.length) {
                        $elements.each(function(){
                            var $field = $(this).eq(0);
                            
                            if ($field.closest(".form-field, .question-field").length) {
                                $field.addClass("form-field-errored");
                                $field.closest(".form-field, .question-field").append('<div class="form-error">'+message+'</div>');
                                
                                error_outputed = true;
                            }
                        });
                    }
                    
                    if (!error_outputed && $(".form-errors").length) {
                        $(".form-errors").append('<div class="form-error">'+message+'</div>');
                    }
                });
                
                if ($(".form-error").length) {
                    scrollToElement($(".form-error").eq(0), { offset: -100 });
                }
                
                $form.on("submit", ajaxFormHandler);
                $form.trigger("loader.destroy");
            }
        });
        
    } else {
        console.log($form + " missing attribute 'method' or 'action'.");
    }
}


/*
 * jQuery imarcomLoader v1.0
 *
 * Copyright (c) 2012 imarcom
 *
 */
(function($, window, undefined) {
    
    
    $.fn.imarcomLoader = function(options) {
        var default_options = {
            FPS: 5,
            cWidth: 41,
            cHeight: 41,
            cTotalFrames: 17,
            cFrameWidth: 41,
            topMax: 150,
            overlay: true,
            overlayColor: '#ffffff',
            center_by_percent: false,
            content: '',
            overlayOpacity: .6,
            onStart: function(){},
            onEnd: function(){}
        };
        
        
        return this.each(function() {
            var $element = $(this);
            var opts = $.extend(default_options, options);
            var $loader, $content, $overlay, cIndex=0, position, cXpos=0, _continue=true;
            
            if( $element.hasClass('imarcom_loader') ) {
                $element.find('.loader_content').html(opts.content);
                return;
            }
            
            $element.addClass('imarcom_loader');
            position = $element.css('position');
            $element.data('position', position);
            if( jQuery.inArray( position, ['absolute','relative'] )==-1 ) { //not in array
                $element.css('position','relative');
            }
            $loader = $(['<div class="sk-fading-circle">',
                              '<div class="sk-circle1 sk-circle"></div>',
                              '<div class="sk-circle2 sk-circle"></div>',
                              '<div class="sk-circle3 sk-circle"></div>',
                              '<div class="sk-circle4 sk-circle"></div>',
                              '<div class="sk-circle5 sk-circle"></div>',
                              '<div class="sk-circle6 sk-circle"></div>',
                              '<div class="sk-circle7 sk-circle"></div>',
                              '<div class="sk-circle8 sk-circle"></div>',
                              '<div class="sk-circle9 sk-circle"></div>',
                              '<div class="sk-circle10 sk-circle"></div>',
                              '<div class="sk-circle11 sk-circle"></div>',
                              '<div class="sk-circle12 sk-circle"></div>',
                          '</div>'].join('')).hide().appendTo($element);
            if( opts.overlay ) {
                $overlay = $('<div class="loader_overlay"></div>').hide().appendTo($element);
            }
            
            $content = $('<div class="loader_content">' + opts.content + '</div>').hide().appendTo($element);
            
            $element.bind('loader.destroy', destroyLoad).bind('loader.resize', resize);
            
            startAnimation();
            
            function startAnimation() {
                var h = $element.outerHeight(),
                    w = $element.outerWidth();
                
                $loader.css({
                    position: 'absolute',
                    zIndex: 21,
                    width: opts.cWidth + 'px',
                    height: opts.cHeight + 'px'
                }).show();
                
                if( opts.overlay ) {
                    $overlay.css({
                        width: 'auto', //more stable with right 0px
                        height: '100%',
                        position: 'absolute',
                        zIndex: 20,
                        top: '0px',
                        left: '0px',
                        right: '0px', //more stable with width auto
                        backgroundColor: opts.overlayColor,
                        opacity: opts.overlayOpacity
                    }).show();
                }
                
                $content.css({
                    position: 'absolute',
                    width: '100%',
                    left: 0,
                    zIndex : 21,
                    color: '#666',
                    textAlign: 'center'
                }).show().trigger('loader.resize');
                
                opts.onStart();
            }
            
            function resize() {
                var h = $element.outerHeight();
                var w = $element.outerWidth();
                $loader.css({
                    'left' : opts.center_by_percent ? '47%' : (w - opts.cWidth)/2 + 'px',
                    'top' : Math.min(opts.topMax, (h - opts.cHeight)/2) + 'px'
                });
                
                $content.css({
                    top: Math.min(opts.topMax, (h - opts.cHeight)/2) + opts.cHeight + 5
                });
            }
            
            function destroyLoad() {
                _continue = false;
                $('> .sk-fading-circle, > .loader_overlay, > .loader_content', $element).remove();
                $element.
                    removeClass('imarcom_loader').
                    unbind('loader').
                    css('position', '');
                
                opts.onEnd();
            }
            
            this.destroy = destroyLoad;
            
        });
        
    };
    
}(jQuery, window));


$(function(){
    updateScrollTopOffset();
    // updateLogoSize();

    doEventPeriodically($(window), "resize", 100, updateScrollTopOffset);

    // doEventPeriodically($(window), "scroll", 50, updateLogoSize);

    $(".js-scrollToElement").on("click", function(e){
        var $element = $($(this).attr("href"));

        if ($element.length) {
            e.preventDefault();
            scrollToElement($element);
        }
    });

    if ($(".js-leftMenu").length) {
        $(".js-leftMenu").stick_in_parent({
            sticky_class: "leftMenu-stuck",
            offset_top: scrollTopOffset
        });
    }

    $(".js-expandable-button").on("click", function(){
        var $expandable = $(this).closest(".expandable");
        var $content = $expandable.find(".expandable-content");

        $(".expandable-content").stop().animate({
            height: 0
        }, 300);

        $(".expandable-opened").not($expandable).removeClass("expandable-opened");

        $expandable.toggleClass("expandable-opened");

        if ($expandable.hasClass("expandable-opened")) {
            var current_height = $content.height();
            $content.css("height", "auto");

            var full_height = $content.height();
            $content.css("height", current_height);

            $content.stop().animate({
                height: full_height
            }, 300);
        } else {
            $content.stop().animate({
                height: 0
            }, 300);
        }
    });

    $('*[data-toggle="modal"]').on("click", function(){
        $(".modal").find(".form-error").remove();
        $(".modal").find(".form-field-errored").removeClass("form-field-errored");
        $(".modal").modal("hide");
    });

    $(".js-ajaxForm").on("submit", function(e){
        e.preventDefault();
    });

    $(".js-ajaxForm").on("submit", ajaxFormHandler);

    /*
    $(".js-autoSubmitForm").not(".question-form-modifying").each(function(){
        var $form = $(this);
        var $autoSubmitInputs = $(":input", $form).not('[type="submit"]');
        var fields = [];

        $autoSubmitInputs.each(function(){
            var name = $(this).attr("name");

            if (fields.indexOf(name) < 0 && name != "_token") { // Change this if not ALL fields are required to skip to next step
                fields.push(name);
            }
        });

        $autoSubmitInputs.change(function(){
            var autoSubmit = true;

            for (var i = 0; i < fields.length; i++) {
                if (!$form.find('*[name="'+fields[i]+'"]:checked').length) { // Change if not ALL fields are checkboxes
                    autoSubmit = false;
                }
            }

            if (autoSubmit) {
                $form.trigger("submit");
            }
        });
    });
    */

    // l'argument "placeholder" est requis sinon la première <option value=""> deviens sélectionnable
    $(".js-select2").each(function(){
        var placeholder = "";
        var dropdownCssClass = $(this).attr('data-select2class') ? $(this).attr('data-select2class') : null;
        if ($(this).attr("placeholder") !== undefined) {
            placeholder = $(this).attr("placeholder");
        }
        $(this).select2({ 
          placeholder: placeholder, 
          minimumResultsForSearch: Infinity,
          dropdownCssClass: dropdownCssClass
        });
    });

    $(".js-fileUpload").on("change", function(e){
        var filename = $(this).val();

        filename = filename.replace(/.*[\/\\]/, '');
        updateFileInputPhoto(this);
        $('label[for="'+$(this).attr("id")+'"]').text(filename);
    });

    $(".js-fakeInput").each(function(){
        var $fakeInput = $(this);
        var $realInput = $($(this).data('real-input'));

        if ($realInput.length) {
            $fakeInput.on("click", function(){
                var checked = $realInput.prop("checked");

                if (checked && !$realInput.is('[type="radio"]')) {
                    $realInput.prop("checked", false).trigger("change");
                } else {
                    $realInput.prop("checked", true).trigger("change");
                }
            });
        }

        $realInput.on("change", function(){
            if ($(this).prop("checked")) {
                if ($(this).is('[type="radio"]')) {
                    var name = $(this).attr("name");
                    var $otherInputs = $('*[name="'+name+'"]').trigger("uncheck");
                }

                $fakeInput.addClass("fakeInput-checked");
            } else {
                $fakeInput.removeClass("fakeInput-checked");
            }
        }).on("uncheck", function(){
            $fakeInput.removeClass("fakeInput-checked");
        });
    });

    $(":input, .select2-selection").on("change focus", function(){
        $(this).closest(".form-field, .question-field").find(".form-error").remove();
    });

    $(".js-contactMethod").on("change", function(){
        if ($(this).val() == 'phone') {
            $(".js-contactHours").addClass("question-contactInformationContactHours-visible");
        } else {
            $(".js-contactHours").removeClass("question-contactInformationContactHours-visible");
        }
    });

    $(".js-question-progressionSelect").on("change", function(){
        window.location = $(this).val();
    });

    if (window.location.hash) {
        if ($(window.location.hash).length) {
            $(window).scrollTop(0);
            scrollToElement($(window.location.hash));
        }
    }

    $("body").on("click", "a, button", function(e){
        var href = $(this).attr("href");

        if (href !== undefined) {
            var hrefParts = href.split("#");

            if (hrefParts.length > 1 && hrefParts[1] != "" && $("#" + hrefParts[1]).length) {
                e.preventDefault();
                scrollToElement($("#" + hrefParts[1]));
            }
        }
    });

    if ($("#modal-randomMessage").length) {
        $("#modal-randomMessage").modal();
    }

    var $profileModifyAddressForm = $(".js-profile-modifyAddressForm");
    
    $(".js-profileAddress").on("click", function(){
        var profile_address = $(this).find(".js-profileAddress-address").text();
        var profile_city = $(this).find(".js-profileAddress-city").text();
        var profile_province = $(this).find(".js-profileAddress-province").data('province');
        var profile_postalCode = $(this).find(".js-profileAddress-postalCode").text();
        var profile_id = $(this).data("id");
        
        profileModifyAddress(profile_address, profile_city, profile_province, profile_postalCode, profile_id);
    });
    
    $(".js-profileAddAddress").on("click", function(){
        profileModifyAddress('', '', '', '', 'new');
    });
    
    function profileModifyAddress(profile_address, profile_city, profile_province, profile_postalCode, profile_id){
        $profileModifyAddressForm.addClass("profile-modifyAddressForm-visible");
        
        $profileModifyAddressForm.find("#addressField").val(profile_address);
        $profileModifyAddressForm.find("#cityField").val(profile_city);
        $profileModifyAddressForm.find("#provinceField").val(profile_province).trigger("change");
        $profileModifyAddressForm.find("#postalCodeField").val(profile_postalCode);
        $profileModifyAddressForm.find("#addressIdField").val(profile_id);
    }
    
    doEventPeriodically($(window), 'resize', 200, updateFullWidthImage);
    doEventPeriodically($(window), 'scroll', 50, updateFullWidthImage);
    
    updateFullWidthImage();
    
    function updateFullWidthImage() {
        var fullWidthImageHeight = $(".fullwidthImage").height() + $(".navbar").height();
        var currentBottomScroll = getScrollTop() + $(window).height();
        
        if (currentBottomScroll >= fullWidthImageHeight) {
            $(".js-fullwidthImage-link").removeClass("positionFixed");
            
        } else {
            $(".js-fullwidthImage-link").addClass("positionFixed");
        }
        
    }
    
    $("body").on("click", function(e){
        var $target = $(e.target);
        
        if (!$target.hasClass("navbar-toggle") && $target.closest(".navbar-toggle").length == 0) {
            $("#app-navbar-collapse").removeClass("in");
        }
    });
    
    $(".js-openableKit").on("click", function(){
        if (!$(this).hasClass("openableKit-opened")) {
            $(".js-openableKit").removeClass("openableKit-opened");
            $(this).addClass("openableKit-opened");
        } else {
            $(this).removeClass("openableKit-opened");
        }
    });
});


// // 2. This code loads the IFrame Player API code asynchronously.
// var tag = document.createElement('script');

// tag.src = "https://www.youtube.com/iframe_api";
// var firstScriptTag = document.getElementsByTagName('script')[0];
// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// // 3. This function creates an <iframe> (and YouTube player)
// //    after the API code downloads.
// var player;

// function onYouTubeIframeAPIReady() {
//     player = new YT.Player('homeVideo', {
//         width: '560',
//         height: '315',
//         videoId: 'hK6f34Atc0M',
//         playerVars: {
//             'autoplay': 1,
//             'loop' : 1,
//             'playlist' : 'hK6f34Atc0M',
//             'rel' : 0,
//             'controls': 0,
//             'showinfo' : 0
//         },
//         events: {
//             'onReady': function (event){
//                 document.getElementById("videoOverlay").className = 'videoOverlay-fadeout';
//                 event.target.playVideo();
//                 event.target.mute();
//             }
//         }
//     });
// }
(function ($, undefined) {

    $('.js-kits-editImageLabel').hide();

    $('.js-kits-photoInput').each(function () {
        var $element = $(this);

        $element.on("change", function() {
            var reader = new FileReader();

            if (this.files && this.files[0]) {
                $('.js-kits-editImageLabel').show();
                reader.onload = function (e) {
                    $element.parent().find('.js-kits-photo').remove();
                    $element.after($('<img class="kits-photo js-kits-photo">').attr("src", e.target.result));
                    $element.hide();
                    $element.prev().hide()
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

})(jQuery);
(function ($, undefined) {

    var submitButtonText = {
        "draft": "SAUVEGARDER LE KIT",
        "submit": "ENVOYER LE KIT"
    };

    $('.js-kits-status').bind('change', function () {
        $('.js-kits-submitButton').html(submitButtonText[$(this).val()]);
    });

})(jQuery);
(function ($, window, undefined) {

    var markers = [];

    var Marker = function (x, y) {
        this.markerElement = $($('#markerTemplate').html());

        this.startDragging();
        this.state = "moving";
        this.move({
            pageX: x,
            pageY: y
        });

        this.markerElement.appendTo(".js-kits-photoContainer");

        this.bindEvents();
        markers.push(this);

        return this;
    };

    Marker.prototype.bindEvents = function () {
        var self = this;

        this.markerElement.find(".js-marker-pin").bind("mousedown", $.proxy(this.startDragging, this));
        this.markerElement.find(".js-marker-pin").bind("mouseup", $.proxy(this.stopDragging, this));
        this.markerElement.find(".js-marker-remove").bind("click", function (e) {
            e.preventDefault();
            self.delete();
        });
        this.markerElement.bind("mousemove", function (e) {
            self.move(e);
        });

        this.markerElement.on('dragstart', function (e) {
            e.preventDefault();
        });

        return this;
    };

    Marker.prototype.move = function (e) {

        if (this.state !== "moving") {
            return;
        }

        var relativePosition = getRelativePosition(e.pageX, e.pageY);

        this.markerElement.css({
            top: relativePosition.y,
            left: relativePosition.x
        });

        this.markerElement.find(".js-marker-x").val(relativePosition.x);
        this.markerElement.find(".js-marker-y").val(relativePosition.y);

        this.moved = true;

        return this;
    };

    Marker.prototype.startDragging = function () {
        this.setState("moving");
        this.moved = false;

        if (!this.isFormVisible()) {
            this.moved = true;
        }

        this.animatePin();

        hideMarkersForm();
        this.showForm();

        return this;
    };

    Marker.prototype.stopDragging = function () {
        this.setState("stationary");

        if (!this.moved) {
            this.hideForm();
        }

        return this;
    };

    Marker.prototype.delete = function () {
        this.markerElement.remove();
    };

    Marker.prototype.setState = function (state) {
        this.state = state;

        return this;
    };

    Marker.prototype.hideForm = function () {
        this.markerElement.removeClass("marker-active");

        return this;
    };

    Marker.prototype.showForm = function () {
        this.markerElement.addClass("marker-active");

        return this;
    };

    Marker.prototype.isFormVisible = function () {
        return this.markerElement.hasClass("marker-active");

        return this;
    };

    Marker.prototype.animatePin = function () {
        this.markerElement.find(".js-marker-pin").addClass('animated swing').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass('animated swing');
        });

        return this;
    };

    Marker.prototype.fillForm = function (data) {
        var $marker = this.markerElement;

        $.each(data, function (key, value) {
            var $field = $marker.find('[name="product[' + key + '][]"]');

            if ($field.length > 0) {
                switch ($field.attr("type")) {
                    case "text":
                    case "hidden":
                        $field.val(value);
                        break;
                    case "radio":
                    case "checkbox":
                        $field.each(function () {
                            if ($(this).attr('value') == value) {
                                $(this).attr("checked", value);
                            }
                        });
                        break;
                    default:
                        $field.val(value)
                }
            }
        });

        return this;
    };



    function getRelativePosition(x, y) {

        if (typeof x === "string" && x.indexOf("%") !== -1) {
            return {
                x: x,
                y: y
            };
        }

        var $container = $(".js-kits-photoContainer"),
            imagePosition = $container.offset(),
            imageSize = {
                height: $container.height(),
                width: $container.width()
            };

        return {
            x: (x - imagePosition.left - 22) / imageSize.width * 100 + "%",
            y: (y - imagePosition.top - 22) / imageSize.height * 100 + "%"
        };
    }

    function hideMarkersForm() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].hideForm();
        }
    }


    $("body").on("mousedown", ".js-kits-photo", function (e) {
        new Marker(e.pageX, e.pageY);
    });

    window.Marker = Marker;


})(jQuery, window);
(function($, baseUrl, undefined) {

    $(".js-memberSearch").select2({
        placeholder: "Sélectionner un client",
        language: "fr",
        ajax: {
            url: baseUrl + "/admin/customers/search",
            dataType: "json",
            delay: 250,
            minimumInputLength: 1,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

})(jQuery, baseUrl);