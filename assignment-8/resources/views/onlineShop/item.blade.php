@extends('layouts.main')


@section('content')
    <section class="container text-left" style="background-color: #adb5bd">
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
                    <a href="{{ route('onlineShop.order', ['id' => $item->id]) }}" > Order  </a></small>
            </button></p>
    </div>
    </div>

    </section>

     &nbsp;
    &nbsp;
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default">
                    <div class="panel-heading">Respond</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="comment-form" method="post" action="{{ route('onlineShop.comment', $item->id) }}" >
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                            <input type="hidden" name="item_id" value="{{ $item->id }}" >
                            {{--<input type="hidden" name="comment_id" value="{{ $comment->id }}" >--}}
                            <input type="hidden" name="name" value="{{ Auth::user()->name}}" >
                            <div class="row" style="padding: 10px;">
                                <div class="form-group col-12">
                                    <textarea class="form-control" name="comment" placeholder="Write a customer review..!"></textarea>
                                </div>
                            </div>
                            <div class="row" style="padding: 0 10px 0 10px;">
                                <div class="form-group col-12">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%" name="submit">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>

                    <div class="panel-body comment-container" >

                        @foreach($item->comments as $comment)
                            <div class="well">
                                <i><b> {{ $comment->name }} </b></i>&nbsp;&nbsp;
                                <span> {{ $comment->comment }} </span>
                                <div style="margin-left:10px;">
                                    <a style="cursor: pointer;" cid="{{ $comment->id }}" name_a="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                    <a style="cursor: pointer;"  class="delete-comment"  href="{{route('onlineShop.comment.delete', $comment->id)}}" >Delete</a>
                                    <div class="reply-form">

                                        <!-- Dynamic Reply form -->

                                    </div>
                                    @foreach($item->replies as $rep)
                                        @if($comment->id === $rep->comment_id)
                                            <div class="well">
                                                <i><b> {{ $rep->name }} </b></i>&nbsp;&nbsp;
                                                <span> {{ $rep->reply }} </span>
                                                <div style="margin-left:10px;">
                                                    <a rname="{{ Auth::user()->name }}" rid="{{ $comment->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">Reply</a>&nbsp;
                                                    <a did="{{ $rep->id }}" class="delete-reply"  href="{{route('onlineShop.reply.delete', $reply->id)}}" >Delete</a>
                                                </div>
                                                <div class="reply-to-reply-form">

                                                    <!-- Dynamic Reply form -->

                                                </div>

                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>



    </div>



    <div class="card mb-4 shadow-sm text-left" style="background-color: #adb5bd">
        <div class="card-body">
        <span>{{$item->comments->count()}} {{ str_plural('comment', $item->comments->count()) }}</span>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>


