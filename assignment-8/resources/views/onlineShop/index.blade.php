@extends('layouts.main')

@section('content')
    <main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading quote">Store Goods</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            @foreach($items as $item)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"> {{ $item->name }} </p>
                        <p class="card-text"> {{ $item->detail }}</p>
                        <p style="font-weight: bold">
                            @foreach($item->tags as $tag)
                                - {{ $tag->tagit }}
                            @endforeach
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('onlineShop.item', ['id' => $item->id]) }}" >View</a>
                            </div>
                            <small class="text-muted">{{ $item->price }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        {{ $items->links() }}
                    </div>
                </div>
        </div>
    </div>

    </main>

@endsection