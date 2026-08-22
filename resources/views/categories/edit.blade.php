@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="mb-5">
                <p class="text-muted-custom mb-2">Update Data</p>
                <h1 class="dashboard-title mb-1">Edit Category</h1>
                <p class="text-muted mb-0">Perbarui informasi category.</p>
            </div>


            {{-- Back Link (Mobile) --}}

            <a href="{{ route('categories.index') }}" class="btn-soft d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>


            {{-- Form Card --}}

            <div class="dashboard-card p-4 p-md-5">

                @if($errors->any())

                    <div class="alert alert-flash-danger mb-4">

                        <strong>
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Ada beberapa kesalahan:
                        </strong>

                        <ul>

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

                    <div class="mb-4">

                        <label
                            for="name"
                            class="form-label"
                        >
                            Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}"
                            placeholder="{{ $category->name }}"
                            required
                        >

                        @error('name')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Type --}}

                    <div class="mb-4">

                        <label class="form-label">
                            Type
                        </label>

                        <div class="segmented-control">

                            <input
                                type="radio"
                                name="type"
                                id="type_income"
                                value="income"
                                {{ old('type', $category->type) === 'income' ? 'checked' : '' }}
                                required
                            >

                            <label class="segmented-option" for="type_income">
                                <i class="bi bi-arrow-down-left"></i> Income
                            </label>

                            <input
                                type="radio"
                                name="type"
                                id="type_expense"
                                value="expense"
                                {{ old('type', $category->type) === 'expense' ? 'checked' : '' }}
                            >

                            <label class="segmented-option" for="type_expense">
                                <i class="bi bi-arrow-up-right"></i> Expense
                            </label>

                        </div>

                        @error('type')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Action --}}

                    <div class="d-flex gap-2 pt-2">

                        <a
                            href="{{ route('categories.index') }}"
                            class="btn btn-soft px-4"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-dark px-4"
                        >
                            <i class="bi bi-save-fill me-2"></i>
                            Update Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
