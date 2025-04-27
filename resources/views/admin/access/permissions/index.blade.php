@extends('layouts.admin')
@section('title', 'Permissions')
@section('content')
    <div class="card shadow-lg">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">Permissions</h5>
                <button type="button" class="btn btn-primary btn-md me-2" data-bs-toggle="modal"
                    data-bs-target="#createPermissionModal">
                    <i class="ti ti-plus"></i> Create
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">SL No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Permission</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $index => $permission)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $permission->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">

                                        @if ($permission->name != 'manage_access')
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary btn-md me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPermissionModal{{ $permission->id }}">
                                                    <i class="ti ti-edit"></i> Edit
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('permissions.destroy', $permission->id) }}"
                                                    id="delete-form-{{ $permission->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-md"
                                                        onclick="confirmDelete({{ $permission->id }})">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <p>Default</p>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Edit Permission Modal -->
                                <div class="modal fade" id="editPermissionModal{{ $permission->id }}" tabindex="-1"
                                    aria-labelledby="editPermissionLabel{{ $permission->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('permissions.update', $permission->id) }}"
                                                method="PUT">
                                                @csrf
                                                @method('GET')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editPermissionLabel{{ $permission->id }}">
                                                        Edit Permission</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="permission-name-{{ $permission->id }}"
                                                            class="form-label">Permission Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="permission-name-{{ $permission->id }}"
                                                            value="{{ $permission->name }}" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update
                                                        Permission</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No permissions found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create Permission Modal -->
    <div class="modal fade" id="createPermissionModal" tabindex="-1" aria-labelledby="createPermissionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="modal-header">
                        <h5 class="modal-title" id="createPermissionLabel">Create Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="permission-name" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control" id="permission-name" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function confirmDelete(permissionId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('delete-form-' + permissionId).submit();
                }
            });
        }
    </script>
@endsection
