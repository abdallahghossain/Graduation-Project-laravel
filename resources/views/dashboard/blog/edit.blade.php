@extends('dashboard.parent')
@section('content')
    <!--begin::Input group-->
    <form action="{{route('dashboard.blog.update' , $data->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <x-alert />
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="name" name="name" placeholder="please inter name"  value="{{ old('name') ?? $data->name}}"/>
            <label for="name">Your name</label>
        </div>
        <div class="form-floating mb-7"><label for="description">description</label>
            <textarea name="description"class="form-control" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-floating mb-7">
            <input type="date" class="form-control" id="data" name="data" placeholder="please inter data"  value="{{ old('date') ?? $data->date}}"/>
            <label for="data">data</label>
        </div>
        <div class="form-floating mb-7">
            <input type="text" class="form-control" name="url" placeholder="please inter URL" id="url"  value="{{ old('url') ?? $data->url}}" />
            <label for="url">Your URL</label>
        </div>
        <div class="form-floating mb-7">
            <div><label for="image" class="form">image</label></div>
             <input type="file" id="image" name="image" class="form-control" value="{{ old('image') ?? $data->image}}>
         </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
    <br>
@endsection
