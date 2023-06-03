@extends('dashboard.parent')
@section('content')
    <div class="col-xl-12">
        <!--begin::Tables Widget 9-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">{{__('Create Product')}}</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
                </h3>
                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                    title="" data-bs-original-title="Click to add a product">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-light btn-active-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                    rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{__('New Product')}}
                    </a>
                </div>
            </div>
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
                                <a href="{{ route('products.create') }}"
                                    class="btn btn-outline-info btn-sm ml-4 mb-3">{{__('Create')}}</a>
                                <a href="{{ route('products.trash') }}"
                                    class="btn btn-outline-danger btn-sm ml-4 mb-3">{{__('Trash')}}</a>
                            </span>
                            <tr class="fw-bolder text-muted">
                                <th class="ps-4 min-w-300px rounded-start">{{__('Image')}}   -   {{__('Id')}} -   {{__('Name')}}</th>
                                <th class="min-w-125px">{{__('Price')}}</th>
                                <th class="min-w-200px">{{__('Description')}}</th>
                                <th class="min-w-125px">{{__('Status')}}</th>
                                <th class="min-w-125px">{{__('deleted_at')}}</th>
                                <th class="min-w-200px text-center">{{__('Actions')}}</th>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                 <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="h-100 w-100" alt="">
                                </span>
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $loop->index + 1 }} - {{ $product->name }}</a>
                                        {{--                                    <span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>--}}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">${{ $product->price }}</a>
                                <span class="text-muted fw-semibold text-muted d-block fs-7 text-decoration-line-through"> ${{ $product->compare_price }}</span>
                            </td>
                            <td>
                                <a href="#" class="text-info fw-bold text-hover-primary d-block mb-1 fs-6">{{ Str::limit($product->description , 15) }}</a>
                                {{--                            <span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>--}}
                            </td>
                            <td>
                                <div class="status">
                                    @if($product->status == "active")
                                        <span class="badge badge-light-success"> {{__('active')}} </span>
                                    @endif
                                    @if($product->status == "draft")
                                        <span class="badge badge-light-danger"> {{__('draft')}} </span>
                                    @endif
                                    @if($product->status == "archived")
                                        <span class="badge badge-light-warning"> {{__('archived')}} </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $product->created_at }}</a>
                            </td>
                            <td class="text-end">

                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">
                                    {{__('Edit')}}
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" class="btn-sm px-4 me-2 gap-2 d-inline-flex" method="post" >
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class="btn btn-bg-light btn-color-muted btn-active-color-danger btn-sm px-4 me-2" >{{__('Delete')}}</button>
                                </form>

                            </td>
                        </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{__('No Products Found')}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
        </div>
        <!--end::Tables Widget 9-->
@endsection

