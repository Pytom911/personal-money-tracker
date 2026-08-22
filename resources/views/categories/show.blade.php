@extends('layouts.app')

@section('title', 'Detail Category')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <p class="text-muted-custom mb-2">Category Detail</p>
                    <h1 class="dashboard-title mb-1">Detail Category</h1>
                    <p class="text-muted mb-0">Informasi lengkap category.</p>
                </div>

                <a
                    href="{{ route('categories.index') }}"
                    class="btn-soft d-inline-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
            </div>


            {{-- Detail Card --}}

            <div class="dashboard-card overflow-hidden">

                {{-- Name Highlight --}}

                @if($category->type === 'income')

                    <div class="card-balance-highlight p-4 p-md-5 text-center">
                        <div class="summary-icon transaction-income mx-auto mb-3 shadow-sm">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="letter-spacing: 1px;">
                            Category
                        </small>
                        <div class="summary-value text-capitalize">{{ $category->name }}</div>
                        <span class="badge badge-type badge-income mt-3">
                            Income
                        </span>
                    </div>

                @else

                    <div class="card-balance-highlight p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #7f1d1d 0%, #ef4444 100%);">
                        <div class="summary-icon transaction-expense mx-auto mb-3 shadow-sm">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="letter-spacing: 1px;">
                            Category
                        </small>
                        <div class="summary-value text-capitalize">{{ $category->name }}</div>
                        <span class="badge badge-type badge-expense mt-3">
                            Expense
                        </span>
                    </div>

                @endif


                {{-- Info Rows --}}

                <div class="p-4 p-md-5">

                    <div class="detail-row">
                        <span class="detail-label">Type</span>

                        @if($category->type === 'income')
                            <span class="badge badge-type badge-income">
                                Income
                            </span>
                        @else
                            <span class="badge badge-type badge-expense">
                                Expense
                            </span>
                        @endif
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">ID</span>
                        <span class="detail-value">#{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Created At</span>
                        <span class="detail-value">
                            <i class="bi bi-calendar-event me-2 text-muted"></i>{{ $category->created_at->format('d F Y, H:i') }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Updated At</span>
                        <span class="detail-value">
                            <i class="bi bi-clock-history me-2 text-muted"></i>{{ $category->updated_at->format('d F Y, H:i') }}
                        </span>
                    </div>


                    {{-- Actions --}}

                    <div class="d-flex gap-2 pt-4 mt-2">

                        <a
                            href="{{ route('categories.edit', $category) }}"
                            class="btn btn-dark px-4"
                        >
                            <i class="bi bi-pencil-square me-2"></i>
                            Edit Category
                        </a>

                        <form
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus category ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-outline-danger px-4 rounded-3 fw-semibold"
                            >
                                <i class="bi bi-trash me-2"></i>
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
