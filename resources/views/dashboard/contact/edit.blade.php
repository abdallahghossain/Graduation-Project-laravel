@extends('dashboard.parent')
@section('content')
    <!--begin::Input group-->
    <form action="{{route('dashboard.contact.update' , $data->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <x-alert />
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="address" name="address" placeholder="please inter address" value="{{ old('address') ?? $data->address}}"  />
            <label for="name">Your address</label>
        </div>
        <div class="form-floating mb-7">
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="please inter mobile"  value="{{ old('mobile') ?? $data->mobile}}" />
            <label for="name">Your mobile </label>
        </div>
        <div class="form-floating mb-7">
            <input type="email" class="form-control" id="email" name="email" placeholder="please inter email"  value="{{ old('email') ?? $data->email}}" />
            <label for="name">Your email</label>
        </div>
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="website" name="website" placeholder="please inter website"  value="{{ old('website') ?? $data->website}}" />
            <label for="name">Your website</label>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
    <br>
@endsection
