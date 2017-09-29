
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