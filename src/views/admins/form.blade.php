@extends('admincore::layouts.dashboard')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrators</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        @if(count($errors))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul>
                            @foreach($errors as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    @endif
    <!-- /.row -->
        <div class="row">
            <div class="col-xs-6">
                <form action="{{route('admin.admins.form', ['id' => $user->id])}}" method="post" role="form">


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder=""
                               value="{{old('name', $user->name)}}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email <sup>*</sup></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder=""
                               value="{{old('email', $user->email)}}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder=""
                               value="">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation" placeholder="" value="">
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

    </div>
@stop