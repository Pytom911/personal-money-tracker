@extends('layouts.app')

@section('title', 'Tambah Category')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="mb-5">
                <p class="text-muted-custom mb-2">New Tag</p>
                <h1 class="dashboard-title mb-1">Add Wishlist</h1>
                <p class="text-muted mb-0">Tambahkan Wishlist baru ke finance tracker.</p>
            </div>


            {{-- Back Link (Mobile) --}}

            <a href="{{ route('wishlist.index') }}" class="btn-soft d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>


            {{-- Form Card --}}

            <div class="dashboard-card p-4 p-md-5">

                @if ($errors->any())

                    <div class="alert alert-flash-danger mb-4">

                        <strong>
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Ada beberapa kesalahan:
                        </strong>

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif
                <form action="{{ route('wishlist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    {{-- Name --}}

                    <div class="mb-4">

                        <label for="name" class="form-label">
                            Name
                        </label>

                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Contoh: Jam Tangan" required>

                        @error('name')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Image --}}

                    <div class="mb-4">

                        <label for="image" class="form-label">
                            Image
                        </label>

                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg,image/webp" required>

                        @error('type')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Amount --}}

                    <div class="mb-3">

                        <label for="target_amount" class="form-label">
                            Target Amount
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input type="number" id="target_amount" name="target_amount"
                                class="form-control @error('target_amount') is-invalid @enderror"
                                value="{{ old('target_amount') }}" placeholder="Contoh: 50000" min="0" required>

                        </div>

                        @error('target_amount')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Description --}}
                    <div class="mb-4">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3" placeholder="Contoh: Jam tangann" required>{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Deadline --}}
                    <div class="mb-4">

                        <label for="deadline" class="form-label">
                            Deadline
                        </label>

                        <input type="date" id="deadline" name="deadline"
                            class="form-control @error('deadline') is-invalid @enderror"
                            value="{{ old('deadline', date('Y-m-d')) }}" required>{{ old('deadline') }}</input>

                        @error('deadline')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select name="status" id="status" class="form-select" required>
                            <option value="">Pilih status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        @error('status')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Action --}}

                    <div class="d-flex gap-2 pt-2">

                        <a href="{{ route('categories.index') }}" class="btn btn-soft px-4">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-dark px-4">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Simpan Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
