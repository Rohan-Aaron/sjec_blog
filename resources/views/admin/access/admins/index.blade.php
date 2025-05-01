@extends('layouts.admin')
@section('title', 'Admins')
@section('content')
    <div class="card shadow-lg">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">Users</h5>
                <a href="{{route('admins.create')}}">
                    <button type="button" class="btn btn-primary btn-md me-2">
                        <i class="ti ti-plus"></i> Create
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">SL No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <form action="{{ route('admins.updateStatus', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="status" value="{{ $user->status }}">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                {{ $user->status == '1' ? 'checked' : '' }}
                                                onchange="this.previousElementSibling.value = this.checked ? 1 : 0; this.form.submit();"
                                            >
                                        </div>
                                    </form>
                                    
                                </td>
                                

                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif
@endsection

