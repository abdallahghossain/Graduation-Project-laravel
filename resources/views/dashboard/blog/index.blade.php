@extends('dashboard.parent')
@section('content')
    <div class="py-10">
        <!--begin::Heading-->
        <h1 class="anchor fw-bolder mb-5" id="striped-rounded-bordered">
            <a href="#striped-rounded-bordered"></a>Striped, Rounded &amp; Bordered
        </h1> <br>
        <!--end::Heading-->
        <!--begin::Block-->

        <div class="my-5">
            <table class="table table-rounded table-striped border gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>id</th>
                        <th>image</th>
                        <th>Name</th>
                        <th>description</th>
                        <th>URL</th>
                        <th>Data</th>
                        <th>option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blog as $data)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img src=" {{ asset('storage/' . $data->image) }}" style="width: 50px;height: 50px"
                                    alt="">
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->url }}</td>
                            <td>{{ $data->date }}</td>
                            <td class="options d-flex gap-2">
                                <a class="btn btn-info" href="{{ route('dashboard.blog.edit', $data->id) }}">Edit</a>
                                <form action="{{ route('dashboard.blog.delete', $data->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
