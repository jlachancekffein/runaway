@extends('layouts.internal-pages')

@section('content')
    <div class="container">
        <h1 class="mainTitle">Taxes</h1>

        <form action="/admin/taxes/save" method="post">
            {{ csrf_field() }}

            <table class="table">
                <thead>
                    <tr>
                        <th>Province</th>
                        <th>Taxe (#1)</th>
                        <th>Taxe (#2)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($provinces as $province)
                        <tr>
                            <td>{{ trans('general.' . $province->key) }}</td>
                            @foreach ($province->taxes as $tax)
                                <td>
                                    <input type="hidden" name="id[]" value="{{ $tax->id }}">
                                    <input type="text" name="key[]" value="{{ $tax->key }}" placeholder="Nom de la taxe">
                                    <input type="text" name="percentage[]" value="{{ $tax->formatted_percentage }}" placeholder="Pourcentage (ex. : 0.05)">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>
    </div>
@endsection
