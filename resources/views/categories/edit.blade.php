<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Category</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-6">

                <div class="mb-4">

                    <h1 class="fw-bold mb-1">
                        Edit Category
                    </h1>

                    <p class="text-muted">
                        Perbarui informasi category.
                    </p>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        @if($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Ada beberapa kesalahan:
                                </strong>

                                <ul class="mb-0 mt-2">

                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <form
                            action="{{ route('categories.update', $category) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="mb-3">

                                <label
                                    for="name"
                                    class="form-label fw-semibold"
                                >
                                    Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Type --}}
                            <div class="mb-4">

                                <label
                                    for="type"
                                    class="form-label fw-semibold"
                                >
                                    Type
                                </label>

                                <select
                                    id="type"
                                    name="type"
                                    class="form-select @error('type') is-invalid @enderror"
                                    required
                                >

                                    <option
                                        value="income"
                                        {{ old('type', $category->type) === 'income' ? 'selected' : '' }}
                                    >
                                        Income
                                    </option>

                                    <option
                                        value="expense"
                                        {{ old('type', $category->type) === 'expense' ? 'selected' : '' }}
                                    >
                                        Expense
                                    </option>

                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Action --}}
                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('categories.index') }}"
                                    class="btn btn-light border"
                                >
                                    Batal
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Update Category
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
