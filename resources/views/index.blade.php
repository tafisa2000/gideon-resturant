@extends('admin_dashboard')
@section('admin')


<div class="content">

                    <div class="container-fluid">
                        
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                      
                                    </div>
                                    <h4 class="page-title">Menu Available</h4>
                                </div>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <form class="d-flex flex-wrap align-items-center">
                                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                                    <div class="me-3">
                                                        <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <label for="status-select" class="me-2">Sort By</label>
                                                    <div class="me-sm-3">
                                                        <select class="form-select my-1 my-lg-0" id="status-select">
                                                            <option selected="">All</option>
                                                            <option value="1">Popular</option>
                                                            <option value="2">Price Low</option>
                                                            <option value="3">Price High</option>
                                                            <option value="4">Sold Out</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        @foreach ($menus as $key => $item)
                            <div class="col-md-6 col-lg-4 col-xl-3">

                            
                                <div class="card product-box">
                                    <div class="card-body">
                                        <div class="product-action">
                                            <a href="javascript: void(0);" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-danger btn-xs waves-effect waves-light"><i class="mdi mdi-close"></i></a>
                                        </div>
    
                                        <div class="bg-light">
                                            <img src="{{ asset($item->image_url) }}" alt="product-pic" class="img-fluid" />
                                        </div>
                                        <div class="product-info">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="font-16 mt-0 sp-line-1"><a href="ecommerce-product-detail.html" class="text-dark">{{ $item->name }}</a> </h5>
                                                    <h5 class="m-0"> <span class="text-muted"></span></h5>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="product-price-tag">
                                                    {{ $item->price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @endforeach
                        <div class="row">
                            <div class="col-12">
                                <ul class="pagination pagination-rounded justify-content-end mb-3">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> 

@endsection
