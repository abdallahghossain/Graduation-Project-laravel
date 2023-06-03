@extends('dashboard.parent')
@section('content')
    <!--begin::Input group-->
    <form action="{{route('dashboard.coupon.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
       <x-alert />
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="name" name="name" placeholder="please inter name" />
            <label for="name">Code Name</label>
        </div>
        <div class="form-floating mb-7">
            <input type="name" class="form-control" id="discount" name="discount" placeholder="please inter discount" />
            <label for="name">Your discount %</label>
        </div>
        <div class="form-floating mb-7">
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="please inter expiry_date" />
            <label for="name">expiry_date</label>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
    <br>
@endsection
