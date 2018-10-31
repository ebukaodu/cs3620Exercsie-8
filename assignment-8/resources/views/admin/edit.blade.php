@extends('layouts.main')

@section('content')
    @include('design.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                </div>
                <div class="form-group">
                    <label for="content">Detail</label>
                    <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
                </div>
                <div class="form-group">
                    <label for="content">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}">
                </div>
                @foreach($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ $item->tags->contains($tag->id) ? 'checked' : ''}}>
                            {{ $tag->tagit }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $itemId }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection