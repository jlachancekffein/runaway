<div class="marker marker-active">
    @if (isset($update) && $update)
        <input type="hidden" name="product[id][]">
    @endif
    <input class="js-marker-x" type="hidden" name="product[marker_x][]">
    <input class="js-marker-y" type="hidden" name="product[marker_y][]">
    <img src="/img/tag.png" alt="Marker" class="marker-pin js-marker-pin">
    <div class="marker-form">
        <div class="form-group">
            {{--<select class="form-control" name="product[brand][]" id="brandField">
                <option value="" disabled selected>{{ trans('orders.brand') }}</option>
                <optgroup label="Cheïkha">
                    <option value="360 sweater">360 sweater</option>
                    <option value="Annette Gortz">Annette Gortz</option>
                    <option value="Cambio">Cambio</option>
                    <option value="CBY+White ">CBY+White </option>
                    <option value="Fabiana Filippi">Fabiana Filippi</option>
                    <option value="FTC Cashmere">FTC Cashmere</option>
                    <option value="Georges Rech">Georges Rech</option>
                    <option value="JS Collections">JS Collections</option>
                    <option value="Laurèl">Laurèl</option>
                    <option value="Luisa Cerano">Luisa Cerano</option>
                    <option value="Marie Saint-Pierre">Marie Saint-Pierre</option>
                    <option value="Parakian Paris">Parakian Paris</option>
                    <option value="Peter Reinwald">Peter Reinwald</option>
                    <option value="Raffaello Rossi">Raffaello Rossi</option>
                    <option value="Riani">Riani</option>
                    <option value="Van Laack">Van Laack</option>
                    <option value="Windsor">Windsor</option>
                </optgroup>
                <optgroup label="Josée Laurent">
                    <option value="Betty Barclay">Betty Barclay</option>
                    <option value="Eva et Claudi">Eva et Claudi</option>
                    <option value="Katharina v. Braun">Katharina v. Braun</option>
                    <option value="Maerz">Maerz</option>
                    <option value="Margittes">Margittes</option>
                    <option value="Samoon Collection">Samoon Collection</option>
                    <option value="Taifun Collection">Taifun Collection</option>
                </optgroup>
                <optgroup label="Marc Cain">
                    <option value="Marc Cain">Marc Cain</option>
                </optgroup>
                <optgroup label="Accessoires">
                    <option value="Codello">Codello</option>
                    <option value="Dean Davidson">Dean Davidson</option>
                    <option value="Josh">Josh</option>
                    <option value="Lucie in the sky">Lucie in the sky</option>
                    <option value="Lucie Langlois">Lucie Langlois</option>
                    <option value="Marc Cain Chaussures et sacs-à-main">Marc Cain Chaussures et sacs-à-main</option>
                    <option value="Suzi Roher Accessories">Suzi Roher Accessories</option>
                    <option value="UNOde50">UNOde50</option>
                </optgroup>
            </select>--}}
            <input class="form-control" id="brandField" name="product[brand][]" type="text" placeholder="{{ trans('orders.brand') }}">
        </div>
        <div class="form-group">
            <input class="form-control marker-productName" id="productNameField" type="text" name="product[name][]" placeholder="{{ trans('orders.productName') }}">
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control marker-price" id="priceField" type="text" name="product[regular_price][]" placeholder="{{ trans('orders.price') }}">
                <span class="input-group-addon">$</span>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control marker-discount" id="discountField" type="text" name="product[reduced_price][]" placeholder="{{ trans('orders.reducedPrice') }}">
                <span class="input-group-addon">$</span>
            </div>
        </div>
        <a href="javascript:;" class="btn btn-danger js-marker-remove">Enlever</a>
    </div>
</div>