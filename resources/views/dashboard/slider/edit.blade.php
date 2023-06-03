@extends('dashboard.parent')
@section('content')
    <!--begin::Input group-->
    <form action="{{route('dashboard.slider.update' , $data->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <x-alert />
        <div class="form-floating mb-7">
            <input type="name" class="form-control" name="name" placeholder="please inter name" value="{{ old('name') ?? $data->name}}"/>
            <label for="name">Your Name</label>
        </div>
        <div class="form-floating mb-7">
            <input type="file" class="form-control" name="image" placeholder="please inter image" />
            <label for="image">Your image</label>
        </div>
        <br>

        <div class="form-floating">
            <textarea class="form-control" placeholder="please inter your description" value="{{$data->description}}" name="description" style="height: 100px"></textarea>
            <label for="description">description</label>
        </div><br>
        <div class="form-floating mb-7">
            <input type="text" class="form-control"  value="{{ old('URL') ?? $data->url}}" name="URL" placeholder="please inter URL" />
            <label for="URL">Your URL</label>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
    </form>
    <br>
@endsection
