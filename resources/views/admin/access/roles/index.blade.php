@extends('layouts.admin')
@section('title', 'Roles')
@section('content')
    <div class="card shadow-lg">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">Roles</h5>
                <button type="button" class="btn btn-primary btn-md me-2" data-bs-toggle="modal"
                    data-bs-target="#createRoleModal">
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
                                <h6 class="fw-semibold mb-0">Role</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $role->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        @if ($role->name != 'manage_access')
                                            <div class="d-flex">
                                                <a href="{{ route('roles.showpermissions',$role->id) }}">
                                                    <button type="button" class="btn btn-secondary btn-md me-2">
                                                        <i class="ti ti-edit"></i> Assign
                                                    </button>
                                                </a>
                                                <button type="button" class="btn btn-primary btn-md me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editRoleModal{{ $role->id }}">
                                                    <i class="ti ti-edit"></i> Edit
                                                </button>
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                                    id="delete-form-{{ $role->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-md"
                                                        onclick="confirmDelete({{ $role->id }})">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <p>Default</p>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Edit Role Modal -->
                                <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
                                    aria-labelledby="editRoleLabel{{ $role->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRoleLabel{{ $role->id }}">
                                                        Edit Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="role-name-{{ $role->id }}" class="form-label">Role
                                                            Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="role-name-{{ $role->id }}" value="{{ $role->name }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update
                                                        Role</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No roles found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoleLabel">Create Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="role-name" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" id="role-name" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function confirmDelete(roleId) {
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
                    document.getElementById('delete-form-' + roleId).submit();
                }
            });
        }
    </script>
@endsection
