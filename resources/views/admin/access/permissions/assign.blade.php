@extends('layouts.admin')
@section('title', 'Assign Permissions and Users to ' . $role->name)
@section('content')

    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Permissions</h5>

            <form action="{{ route('roles.assignPermissions', $role->id) }}" method="POST">
                <div class="row">
                    @csrf
                    @foreach ($permissions as $Permission)
                        <div class="col-md-3 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="permissions[]" type="checkbox"
                                    value="{{ $Permission->name }}"
                                    {{ $rolePermissions->contains($Permission->name) ? 'checked' : '' }}
                                    id="perm-{{ $Permission->id }}">
                                <label class="form-check-label"
                                    for="perm-{{ $Permission->id }}">{{ $Permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-secondary btn-md me-2"><i class="ti ti-check"></i>
                    Sync Permissions</button>
            </form>

        </div>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Users</h5>
            <form action="{{ route('roles.assignuser', $role->id) }}" method="POST">
                @csrf
                @method('post')
                <div class="form-group">
                    <label class="mb-1">Assign User</label>
                    <select id="selectUser" name="user" class=" form-control mb-2"></select>
                    @error('user')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary btn-md me-2"><i class="ti ti-check"></i>
                    Assign</button>
            </form>
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
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No users Assigned to this role</td>
                            </tr>
                        @else
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
                                        <form action="{{ route('roles.revokeuser', $user->id) }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-md me-2">
                                                <i class="ti ti-x"></i> Revoke
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Fetch data via AJAX and populate the select options
            $.ajax({
                url: "{{ route('roles.users.fetch') }}",
                dataType: 'json',
                success: function(data) {
                    // Loop through the data and append it to the select
                    var options = '<option value="">Select Admins</option>';
                    $.each(data, function(index, user) {
                        options +=
                            `<option value="${user.id}">${user.name} - ${user.email}</option>`;
                    });
                    $('#selectUser').html(options);
                }
            });
        });
    </script>
@endsection
