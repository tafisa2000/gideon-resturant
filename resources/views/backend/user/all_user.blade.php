@extends('admin_dashboard')

@section('admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">Add</button>
                            </ol>
                        </div>
                        <h4 class="page-title">Employees</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->image_url }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->position }}</td>
                                            <td>
                                                <a href="{{ route('edit.category', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light edit-btn"
                                                    data-id="{{ $item->id }}" data-position="{{ $item->position }}"
                                                    data-first_name="{{ $item->first_name }}"
                                                    data-last_name="{{ $item->last_name }}"
                                                    data-email="{{ $item->email }}" data-bs-toggle="modal"
                                                    data-bs-target="#edit-modal">Edit</a>
                                                <a href="{{ route('delete.user', $item->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input class="form-control" type="text" name="first_name" placeholder=""
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="last_name" placeholder=""
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select class="form-select" name="position" id="add-position-name" required>
                                <option value="" disabled selected>Choose Position</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="cashier">Cashier</option>
                                <option value="kitchen staff">Kitchen Staff</option>
                                <option value="waiter">Waiter</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Picture</label>
                            <div
                                style="border: 2px dashed #007bff; border-radius: 5px; padding: 10px; text-align: center;">
                                <input style="border: none; width: 100%; background: transparent;" type="file"
                                    name="image" accept="image/*">
                            </div>
                            <div class="mt-3 text-center">
                                <img id="edit-menu-image" src="" alt="Current image"
                                    style="max-width: 100%; height: auto; display: none;">
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" method="post" action="{{ route('user.update') }}">
                        @csrf
                        <input type="hidden" name="id" id="edit-user-id">
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Edit User</h5>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="edit-first-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="edit-last-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="edit-email" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select class="form-select" name="position" id="edit-position-name" required>
                                <option value="" disabled>Choose Position</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="cashier">Cashier</option>
                                <option value="kitchen staff">Kitchen Staff</option>
                                <option value="waiter">Waiter</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var position = $(this).data('position');
            var firstName = $(this).data('first_name');
            var lastName = $(this).data('last_name');
            var email = $(this).data('email');

            $('#edit-user-id').val(id);
            $('#edit-position-name').val(position);
            $('#edit-first-name').val(firstName);
            $('#edit-last-name').val(lastName);
            $('#edit-email').val(email);
        });
    </script>
@endsection
