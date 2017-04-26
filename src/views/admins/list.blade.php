@extends('admincore::layouts.dashboard')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrators</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<table class="table table-striped">
                		<thead>
                            <tr>
                                <td colspan="4">
                                    <a href="{{route('admin.admins.form')}}" class="btn btn-md btn-primary">Create</a>
                                </td>
                            </tr>
                			<tr>
                				<th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th><i class="fa fa-cogs"></i></th>
                			</tr>
                		</thead>
                		<tbody>
                        @foreach($users as $user)
                			<tr>
                				<td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    <a href="{{route('admin.admins.form', ['id' => $user->id])}}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('admin.admins.delete', ['id' => $user->id])}}" class="btn btn-danger btn-xs confirm"><i class="fa fa-trash"></i></a>
                                </td>
                			</tr>
                        @endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>

    </div>
@stop