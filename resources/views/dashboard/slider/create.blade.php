@extends('dashboard.parent')
@section('content')
    <!--begin::Input group-->
    <form action="{{route('dashboard.slider.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
       <x-alert />
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="name" name="name" placeholder="please inter name" />
            <label for="name">Your Name</label>
        </div>
        <div class="form-floating mb-7">
            <input type="file" class="form-control" name="image" placeholder="please inter image" />
            <label for="image">Your image</label>
        </div>
        <br>

        <div class="form-floating">
            <textarea class="form-control" id="description" placeholder="please inter your description" name="description" style="height: 100px"></textarea>
            <label for="description">description</label>
        </div><br>
        <div class="form-floating mb-7">
            <input type="text" class="form-control" name="url" placeholder="please inter URL" id="url" />
            <label for="url">Your URL</label>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
    <br>
@endsection
