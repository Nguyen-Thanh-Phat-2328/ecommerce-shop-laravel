@extends('admin/layouts/app')
@section('content')
    <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($blogs as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value->id ?></td>
                                                        <td><?php echo $value->title ?></td>
                                                        <td><?php echo $value->image ?></td>
                                                        <td><?php echo $value->description ?></td>
                                                        <td>
                                                            <a href="{{ url('/admin/blog/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <a href="{{ url('/admin/blog/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }    
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{ url('/admin/blog/add') }}"><button class="btn btn-success">Add Blog</button></a>
                    </div>
            </div>
@endsection