<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Category</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-7">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h1 class="fw-bold mb-1">
                            Detail Category
                        </h1>

                        <p class="text-muted mb-0">
                            Informasi lengkap category.
                        </p>
                    </div>

                    <a
                        href="{{ route('categories.index') }}"
                        class="btn btn-light border"
                    >
                        Kembali
                    </a>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        {{-- Category Name --}}
                        <div class="mb-4">

                            <small class="text-muted">
                                NAME
                            </small>

                            <h3 class="fw-bold mb-0">
                                {{ $category->name }}
                            </h3>

                        </div>

                        {{-- Category Type --}}
                        <div class="mb-4">

                            <small class="text-muted">
                                TYPE
                            </small>

                            <div class="mt-1">

                                @if($category->type === 'income')

                                    <span class="badge text-bg-success fs-6">
                                        Income
                                    </span>

                                @else

                                    <span class="badge text-bg-danger fs-6">
                                        Expense
                                    </span>

                                @endif

                            </div>

                        </div>

                        {{-- Category ID --}}
                        <div class="mb-4">

                            <small class="text-muted">
                                ID
                            </small>

                            <p class="mb-0 fw-semibold">
                                #{{ $category->id }}
                            </p>

                        </div>

                        {{-- Created At --}}
                        <div class="mb-4">

                            <small class="text-muted">
                                CREATED AT
                            </small>

                            <p class="mb-0">
                                {{ $category->created_at->format('d F Y, H:i') }}
                            </p>

                        </div>

                        {{-- Updated At --}}
                        <div class="mb-4">

                            <small class="text-muted">
                                UPDATED AT
                            </small>

                            <p class="mb-0">
                                {{ $category->updated_at->format('d F Y, H:i') }}
                            </p>

                        </div>

                        <hr>

                        {{-- Actions --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('categories.edit', $category) }}"
                                class="btn btn-primary"
                            >
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
                                    class="btn btn-outline-danger"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
