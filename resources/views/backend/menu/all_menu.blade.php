@extends('admin_dashboard')

@section('admin')
    <div class="content">
        <div class="container-fluid">
            <!-- Start Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">Add</button>
                            </ol>
                        </div>
                        <h4 class="page-title">Menus</h4>
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
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }} Tsh</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td> <img src="{{ asset($item->image_url) }}" style="width:60px; height:50px">
                                            </td>

                                            <td>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light edit-btn"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                    data-price="{{ $item->price }}"
                                                    data-description="{{ $item->description }}"
                                                    data-category="{{ $item->category_id }}"
                                                    data-image-url="{{ asset('images/' . $item->image) }}"
                                                    data-bs-toggle="modal" data-bs-target="#edit">Edit</a>
                                                <a href="{{ route('delete.menu', $item->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Add Menu Modal -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="px-3" method="post" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="menu_name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Name" required>
                            </div>
                            <div class="col">
                                <label for="menu_price" class="form-label">Price</label>
                                <input class="form-control" type="text" name="price" placeholder="Price" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter a description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <div style="border: 2px dashed #007bff; border-radius: 5px; padding: 10px; text-align: center;">
                                <input
                                    style="bor                                            der: none; width: 100%; background: transparent;"
                                    type="file" name="image" accept="image/*" required>
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

    <!-- Edit Menu Modal -->
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="editMenuForm" method="post" action="{{ route('menu.update') }}"
                        enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" name="id" id="edit-menu-id">

                        <div class="row mb-3">
                            <div class="col">
                                <label for="menu_name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="edit-menu-name"
                                    placeholder="Name" required>
                            </div>
                            <div class="col">
                                <label for="menu_price" class="form-label">Price</label>
                                <input class="form-control" type="text" name="price" id="edit-menu-price"
                                    placeholder="Price" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit-menu-description" rows="3"
                                placeholder="Enter a description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" id="edit-menu-category" required>
                                <option value="" disabled>Select a category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
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
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <script type="text/javascript">
        $(document).on('click', '.edit-btn', function() {
            var menuId = $(this).data('id');
            var menuName = $(this).data('name');
            var menuPrice = $(this).data('price');
            var menuDescription = $(this).data('description');
            var menuCategory = $(this).data('category');
            var menuImage = $(this).data('image');

            $('#edit-menu-id').val(menuId);
            $('#edit-menu-name').val(menuName);
            $('#edit-menu-price').val(menuPrice);
            $('#edit-menu-description').val(menuDescription);
            $('#edit-menu-category').val(menuDescription);
            $('#edit-menu-image').val(menuImage);
        });
    </script>
@endsection
