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
                    <table class="table table-striped" id="items_table"
                           data-page-length="10"
                    >
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
                                <th>Created date</th>
                                <th><i class="fa fa-cogs"></i></th>
                			</tr>
                		</thead>

                	</table>
                </div>
            </div>
        </div>

    </div>
@stop
@section('js')
    <script type="text/javascript">
        $(function(){
            $('#items_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.admins.datatable') !!}',
                order: [
                    [4, 'desc']
                ],
                columns: [
                    {data:'id', name: 'ID'},
                    {data:'name', name: 'name'},
                    {data:'email', name:'email'},
                    {data:'created_at', searchable:false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@stop