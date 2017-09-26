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