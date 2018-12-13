@extends('layouts.main')


@section('content')
    <section class=" text-left">
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

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default">
                    <div class="panel-heading">Response</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="comment-form" method="post" action="{{ route('comments.store') }}" >
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()}}" >
                            <div class="row" style="padding: 10px;">
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" placeholder="Write a customer review..!"></textarea>
                                </div>
                            </div>
                            <div class="row" style="padding: 0 10px 0 10px;">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" name="submit">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <h3>Comments</h3>
        @if (Auth::check())
            @include('includes.errors')
            {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
            <p>{{ Form::textarea('body', old('body')) }}</p>
            {{ Form::hidden('item_id', $item->id) }}
            <p>{{ Form::submit('Send') }}</p>
            {{ Form::close() }}
        @endif
        @forelse ($item->comments as $comment)
            <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
            <p>{{ $comment->body }}</p>
            <hr>
        @empty
            <p>This post has no comments</p>
        @endforelse

        <span>{{$item->comments->count()}} {{ str_plural('comment', $item->comments->count()) }}</span>

        @endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>


