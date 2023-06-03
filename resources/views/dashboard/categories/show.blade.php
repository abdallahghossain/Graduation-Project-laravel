@extends('dashboard.parent')
@section('content')
    <a href="{{ route('categories.index') }}" class="btn btn-outline-info btn-sm ml-4 mb-3">Back</a>
    <table class="table" id="categories">
        <thead>
            <tr>
                <th></th>
                <th>name</th>
                <th>store</th>
                <th>status</th>
                <th>status</th>
                <th>created_at</th>

            </tr>
        </thead>
        <tbody>
            @php
              $products=$category->products()->with('store')->latest()->paginate(2)
            @endphp
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" alt="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No Categories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
