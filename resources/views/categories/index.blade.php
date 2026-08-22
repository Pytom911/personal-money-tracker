<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categories</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold mb-1">
                    Categories
                </h1>

                <p class="text-muted mb-0">
                    Kelola kategori pemasukan dan pengeluaran.
                </p>
            </div>

            <a
                href="{{ route('categories.create') }}"
                class="btn btn-primary"
            >
                + Tambah Category
            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>

        @endif

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="px-4">#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th class="text-end px-4">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)

                                <tr>

                                    <td class="px-4 fw-semibold">
                                        {{ $category->id }}
                                    </td>

                                    <td>
                                        {{ $category->name }}
                                    </td>

                                    <td>

                                        @if($category->type === 'income')

                                            <span class="badge text-bg-success">
                                                Income
                                            </span>

                                        @else

                                            <span class="badge text-bg-danger">
                                                Expense
                                            </span>

                                        @endif

                                    </td>

                                    <td class="text-end px-4">

                                        <div class="btn-group">

                                            {{-- Detail --}}
                                            <a
                                                href="{{ route('categories.show', $category) }}"
                                                class="btn btn-sm btn-outline-secondary"
                                            >
                                                Detail
                                            </a>

                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('categories.edit', $category) }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('categories.destroy', $category) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus category ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="4"
                                        class="text-center py-5"
                                    >

                                        <div class="text-muted">

                                            <h5 class="mb-2">
                                                Belum ada category
                                            </h5>

                                            <p class="mb-3">
                                                Tambahkan category pertama lu.
                                            </p>

                                            <a
                                                href="{{ route('categories.create') }}"
                                                class="btn btn-primary"
                                            >
                                                + Tambah Category
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>
