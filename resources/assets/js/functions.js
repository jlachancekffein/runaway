
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
