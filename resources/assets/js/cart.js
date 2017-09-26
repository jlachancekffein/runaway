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