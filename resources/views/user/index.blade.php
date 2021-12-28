@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12" style="text-align: center">
            <div>
                <h2>Pocket System</h2>
            </div>
            <br />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-user" data-toggle="modal">New
                    User</a>
            </div>
        </div>
    </div>
    <br />
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p id="msg">{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone</th>
            <th>Status</th>
            <th>image</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($users as $user)
            <tr id="user_id_{{ $user->id }}">
                <td>{{ @$user->id }}</td>
                <td>{{ @$user->name }}</td>
                <td>{{ @$user->email }}</td>
                <td>{{ @$user->phone }}</td>
                <td><input data-id="{{ $user->id }}" class="toggle-class" type="checkbox" data-onstyle="success"
                        data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"
                        {{ $user->status ? 'checked' : '' }}></td>
                <td class="img-fluid"><img style="width: 60%" src="{{ asset('images/' . $user->image) }}" alt=""></td>
                <td class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-success" id="edit-user" data-toggle="modal"
                        data-id="{{ $user->id }}">Edit </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="mx-2 btn btn-danger"> Delete</button>

                    </form>
                </td>
                </td>
            </tr>
        @endforeach

    </table>
    {!! $users->links() !!}
    <!-- Add and Edit user modal -->
    <div class="modal fade" id="crud-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form name="custForm" action="{{ route('users.store') }}" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="cust_id" id="cust_id">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group  @error('name') is-invalid @enderror ">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                        onchange="validate()">
                                    @error('name') <div class="text-danger ">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group  @error('email') is-invalid @enderror">
                                    <strong>Email:</strong>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                        onchange="validate()">
                                    @error('email') <div class="text-danger ">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group @error('password') is-invalid @enderror">
                                    <strong>Password:</strong>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="password" onchange="validate()" onkeypress="validate()">
                                    @error('password') <div class="text-danger ">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group @error('phone') is-invalid @enderror">
                                    <strong>Phone:</strong>
                                    <input type="number" name="phone" id="phone" class="form-control" placeholder="phone"
                                        onchange="validate()" onkeypress="validate()">
                                    @error('phone') <div class="text-danger ">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group @error('image') is-invalid @enderror">
                                    <strong>Image:</strong>
                                    <input type="file" name="image" id="image" class="form-control" placeholder="Image"
                                        onchange="validate()" onkeypress="validate()">
                                    @error('image') <div class="text-danger ">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Submit</button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
