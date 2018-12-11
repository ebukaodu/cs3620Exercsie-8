@extends('layouts.main')

@section('content')
    @include('design.errors')
    <div class="row" style="background-color: #383d41; color: #3f9ae5 ">
        &nbsp;
        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" method="post">
                <div >
                    <label for="image">Name</label>
                    <input type="file" class="form-control" id="pic" name="pic" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="content">Detail</label>
                    <input type="text" class="form-control" id="detail" name="detail">
                </div>
                <div class="form-group">
                    <label for="content">Price</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                @foreach($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                            {{ $tag->tagit }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        &nbsp;
    </div>
@endsection