@extends('dashboard.parent')
@section('content')
    <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-sm ml-4 mb-3">Back</a>
    <table class="table" id="products">
        <thead>
            <tr>
                <th></th>
                <th>name</th>
                <th>description</th>
                <th>price</th>
                <th>compare price</th>
                <th>Category Name</th>
                <th>status</th>
                <th>created_at</th>

            </tr>
        </thead>
        <tbody>

            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" alt="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->compare_price }}</td>
                    <td>{{ $product->category->name }}</td>
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
