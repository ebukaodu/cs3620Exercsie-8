@extends('layouts.main')


@section('content')
    <section class="jumbotron text-left">
        <div class="container">
    <div class="card-body">
        <p class="card-text">{{ $item->name }}</p>
        <!--<p class="card-img-top">{{ $item->pic }}</p>-->
        <div class="row">
            <div class="col-md-12">
                <p>{{ count($item->likes) }} Likes |
                    <a href="{{ route('onlineShop.item.like', ['id' => $item->id]) }}">Like</a></p>
            </div>
        </div>
            <p class="card-text">{{ $item->detail }}</p>
        </div>
    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">{{ $item->price }}</small>
        <p><button type="button" class="btn btn-big btn-outline-secondary"><small class="text-muted">
                    <a href="{{ route('onlineShop.order', ['id' => $item->id]) }}" > Order</a></small>
            </button></p>
    </div>
    </div>

    </section>

    <section class="jumbotron text-center">
        <div class="container">

        </div>
    </section>
@endsection



