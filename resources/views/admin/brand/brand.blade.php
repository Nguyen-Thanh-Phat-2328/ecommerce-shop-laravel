@extends('admin/layouts/app')
@section('content')
    <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Brand</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Brand</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-body">
                                <h4 class="card-title">Table Header</h4>
                                <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($brands as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->id ?></td>
                                                        <td><?php echo $value->brand ?></td>
                                                        <td>
                                                            <a href="{{ url('admin/brand/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="{{ url('admin/brand/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }    
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{ url('/admin/brand/add') }}"><button class="btn btn-success">Add Brand</button></a>
                    </div>
            </div>
@endsection