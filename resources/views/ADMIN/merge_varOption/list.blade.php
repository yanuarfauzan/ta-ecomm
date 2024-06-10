@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>MERGE VARIATION OPTION</h1>
            <div class="section-header-button">
                <a href="/admin/create-merge-varOption" class="btn btn-success">Add New</a>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mx-auto">
        <div class="card-header text-center">
            <h4>List Merge Variation Option</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Variation Option</th>
                            <th scope="col">Merge Stock</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($mergeVariationOptions as $mergeVariationOption)
                        <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $mergeVariationOption->product->name }}</td>
                                <td>{{ $mergeVariationOption->variationOption1->name }} &
                                    {{ $mergeVariationOption->variationOption2->name }}</td>
                                <td>{{ $mergeVariationOption->merge_stock }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-merge-varOption/{{ $mergeVariationOption->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-merge-varOption/{{ $mergeVariationOption->id }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md bg-danger text-light btn-rounded">
                                                <i class="fa-solid fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        @if ($mergeVariationOptions->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $mergeVariationOptions->previousPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $mergeVariationOptions->lastPage(); $i++)
                            <li class="page-item {{ $i == $mergeVariationOptions->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $mergeVariationOptions->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($mergeVariationOptions->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $mergeVariationOptions->nextPageUrl() }}"><i
                                        class="fas fa-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
