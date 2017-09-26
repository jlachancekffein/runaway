@extends('layouts.internal-pages')

@section('content')
    <div class="container">
        <h1 class="mainTitle">{{ trans('orders.newOrder') }}</h1>

        <form class="orderForm" method="post">
            {{ csrf_field() }}

            <fieldset class="orderForm-group">
                <legend>{{ trans('orders.client') }}</legend>
                <div class="form-group">
                    <select class="js-memberSearch form-control" name="member_id" id="memberField" placeholder="{{ trans('orders.selectClient') }}"></select>
                </div>
            </fieldset>

            <fieldset class="orderForm-group">
                <legend>{{ trans('orders.uploadPhoto') }}</legend>
                <div class="orderForm-productUpload">
                    <div class="form-group">
                        <input class="orderForm-imageUpload" type="file" data-target=".orderForm-canvas">
                    </div>
                </div>
            </fieldset>

            <fieldset class="orderForm-group">
                <legend>{{ trans('orders.products') }}</legend>
                <div class="orderForm-canvasContainer">
                    <canvas class="orderForm-canvas"></canvas>
                </div>
            </fieldset>

            <fieldset class="orderForm-group">
                <legend>{{ trans('orders.resume') }}</legend>
            </fieldset>

            <button class="btn btn-primary" type="submit">{{ trans('orders.sendToClient') }}</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/template" id="marker">
        <div class="marker marker-active">
            <img src="/img/tag.png" alt="Marker" class="marker-pin">
            <div class="marker-form">
                <div class="form-group">
                    <label for="brandField">{{ trans('orders.brand') }}</label>
                    <select class="form-control" name="brand[]" id="brandField">
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
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control marker-productName" id="productNameField" type="text" name="product_name[]" placeholder="{{ trans('orders.productName') }}">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control marker-price" id="priceField" type="text" name="price[]" placeholder="{{ trans('orders.price') }}">
                        <span class="input-group-addon">$</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control marker-discount" id="discountField" type="text" name="discount[]" placeholder="{{ trans('orders.reducedPrice') }}">
                        <span class="input-group-addon">$</span>
                    </div>
                </div>
            </div>
        </div>
    </script>
@endpush