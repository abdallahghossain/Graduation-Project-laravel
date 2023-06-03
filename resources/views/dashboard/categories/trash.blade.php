
@extends('dashboard.parent')
@section('content')
    <div class="col-xl-12">
        <!--begin::Tables Widget 9-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <span>
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-info btn-sm ml-4 mb-3">{{__('back')}}</a>
                            </span>
                            <tr class="fw-bolder text-muted">
                                <th class="w-25px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" data-kt-check="true"
                                            data-kt-check-target=".widget-9-check">
                                    </div>
                                </th>
                                <th class="min-w-150px">{{__('Name')}} </th>
                                <th class="min-w-150px"> {{__('products count')}}</th>
                                <th class="min-w-150px">{{__('Description')}}</th>
                                <th class="min-w-150px">{{__('Status')}}</th>
                                <th class="min-w-150px">{{__('deleted_at')}}</th>
                                <th class="min-w-150px">{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input widget-9-check" type="checkbox" value="1">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="">
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->name }}</a>
                                                {{-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->products_count }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->description }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->status }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="text-dark fw-bolder text-hover-primary fs-6">
                                                {{ $category->deleted_at }}</div>
                                        </div>
                                    </td>
                                    <td class=" d-flex gap-1">
                                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-outline-info btn-sm mt-2">{{__('Restore')}}</button>

                                        </form>
                                        <span>
                                            <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2">{{__('Delete')}}</button>

                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{__('No categories found')}}</td>
                                </tr>
                            @endforelse
                        </tbody>

                        <!--end::Table body-->
                    </table>
                    {{ $categories->links() }}

                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
        </div>
        <!--end::Tables Widget 9-->
@endsection

