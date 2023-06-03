@extends('dashboard.parent')
@section('content')
    <div class="col-xl-12">
        <!--begin::Tables Widget 9-->
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">{{__('Create Category')}}</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
                </h3>
                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                    title="" data-bs-original-title="Click to add a category">
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-light btn-active-primary">
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
                        <!--end::Svg Icon-->{{__('New Category')}}
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
                                <a href="{{ route('categories.create') }}"
                                    class="btn btn-outline-info btn-sm ml-4 mb-3">{{__('Create')}}</a>
                                <a href="{{ route('categories.trash') }}"
                                    class="btn btn-outline-danger btn-sm ml-4 mb-3">{{__('Trash')}}</a>
                            </span>
                            <tr class="fw-bolder text-muted">
                                <th class="ps-4 min-w-250px rounded-start">{{__('Image')}}   -   {{__('Id')}} -  {{__('Name')}}</th>
                                <th class="min-w-200px">{{__('products count')}}</th>
                                <th class="min-w-200px">{{__('Description')}}</th>
                                <th class="min-w-125px">{{__('Status')}}</th>
                                <th class="min-w-125px">{{__('deleted_at')}}</th>
                                <th class="min-w-200px text-center">{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light">
                                        <img src="{{ asset('storage/' . $category->image) }}" class="h-100 w-100 " alt="">
                                    </span>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $loop->index + 1 }} - {{ $category->name }}</a>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <a href="#" class="text-info fw-bold text-hover-primary d-block mb-1 fs-6">{{ $category->products_count  }}</a>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $category->description }}</a>
                                </td>
                                <td>
                                    <div class="status">
                                        @if($category->status == "active")
                                            <span class="badge badge-light-success"> {{__('active')}} </span>
                                        @endif
                                        @if($category->status == "draft")
                                            <span class="badge badge-light-danger"> {{__('draft')}} </span>
                                        @endif
                                        @if($category->status == "archived")
                                            <span class="badge badge-light-warning"> {{__('archived')}} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $category->created_at }}</a>
                                </td>
                                <td class="text-end ">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">
                                        {{__('Edit')}}
                                    </a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" class="btn-sm px-4 me-2 gap-2 d-inline-flex " method="post" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-bg-light btn-color-muted btn-active-color-danger btn-sm px-4 me-2" >{{__('Delete')}}</button>
                                    </form>
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
