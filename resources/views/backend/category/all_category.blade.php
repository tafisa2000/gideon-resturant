@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Add</button>
                            </ol>
                        </div>
                        <h4 class="page-title">Categories</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="#" class="btn btn-blue rounded-pill waves-effect waves-light edit-btn" 
                                                   data-id="{{ $item->id }}" data-name="{{ $item->name }}" 
                                                   data-bs-toggle="modal" data-bs-target="#edit">Edit</a>
                                                <a href="{{ route('delete.category', $item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" 
                                                   id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Signup modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" method="post" action="{{ route('category.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input class="form-control" type="text" name="category_name" placeholder="Add Category ">
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit modal content -->
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" method="post" action="{{ route('category.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit</h5>
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Name</label>
                            <input type="text" name="category_name" class="form-control" value="">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.getAttribute('data-name');
                    document.querySelector('input[name="id"]').value = categoryId;
                    document.querySelector('input[name="category_name"]').value = categoryName;
                });
            });
        });
    </script>

@endsection
