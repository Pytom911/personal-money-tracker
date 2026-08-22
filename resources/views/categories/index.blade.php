@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    {{-- Header --}}

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <p class="text-muted-custom mb-2">Organize Money</p>
            <h1 class="dashboard-title mb-1">Categories</h1>
            <p class="text-muted mb-0">Kelola kategori pemasukan dan pengeluaran.</p>
        </div>
        <div class="mt-4 mt-md-0">
            <a href="{{ route('categories.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle-fill me-2"></i> New Category
            </a>
        </div>
    </div>


    {{-- Success Message --}}

    @if(session('success'))

        <div class="alert alert-flash-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>

    @endif


    {{-- Category Card --}}

    <div class="dashboard-card p-4 p-md-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="card-title-custom mb-1">All Categories</h5>
                <small class="text-muted">Semua tag untuk mengelompokkan transaksi</small>
            </div>
            <span class="badge badge-type badge-income">
                {{ $categories->count() }} Items
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-custom table-hover align-middle">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Type
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            {{-- ID --}}

                            <td class="text-muted fw-semibold">
                                #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                            </td>


                            {{-- Name --}}

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($category->type === 'income')

                                        <div class="transaction-icon transaction-income shadow-sm">
                                            <i class="bi bi-arrow-down-left"></i>
                                        </div>

                                    @else

                                        <div class="transaction-icon transaction-expense shadow-sm">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>

                                    @endif

                                    <span class="fw-bold text-dark">
                                        {{ $category->name }}
                                    </span>

                                </div>

                            </td>


                            {{-- Type --}}

                            <td>

                                @if($category->type === 'income')

                                    <span class="badge badge-type badge-income">
                                        Income
                                    </span>

                                @else

                                    <span class="badge badge-type badge-expense">
                                        Expense
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    {{-- Show --}}

                                    <a
                                        href="{{ route('categories.show', $category) }}"
                                        class="btn-action-icon btn-view"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    {{-- Edit --}}

                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="btn-action-icon btn-edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- Delete --}}

                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus category ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action-icon btn-delete border"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="p-0">

                                <div class="empty-state">

                                    <div class="empty-state-icon">
                                        <i class="bi bi-tags"></i>
                                    </div>

                                    <h5 class="card-title-custom mb-1">Belum ada category</h5>

                                    <p class="text-muted mb-4">
                                        Buat category pertamamu untuk mulai mengelompokkan transaksi.
                                    </p>

                                    <a href="{{ route('categories.create') }}" class="btn btn-dark">
                                        <i class="bi bi-plus-circle-fill me-2"></i> New Category
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection
