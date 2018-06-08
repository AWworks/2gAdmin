@extends('layouts.master')

@section('content')

    <div class="left main_content">
        <div class="inner">
            <div class="breadcrumbs">
                <div class="inner">
                    <h2 class="uk-h2">Merchant List</h2>
                </div>
            </div> <!--breadcrumbs-->

            <div class="content_wrap">

                <div class="uk-width-1">
                    <a href="{{route('restaurant.create')}}" class="uk-button"><i class="fa fa-plus"></i> Add New</a>
                </div>

                {{--<table id="example2" class="display" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Dish</th>
                        <th>Status</th>
                        <th>Category-Creator</th>
                        <th>Date Updated</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($foodCat as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->foodCatName}}</td>
                            <td>{{$category->foodCatDescription}}</td>
                            <td>
                                @foreach($category->dishes as $dishes)
                                    {{$dishes->dishName.','}}
                                @endforeach
                            </td>
                            <td>{{$category->foodCatStatus}}</td>
                            <td>{{$category->user->email}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ route('foodCategory.edit',$category->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['foodCategory.destroy', $category->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>--}}
            </div>

        </div> <!--INNER-->
    </div>

    <!--<script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>  -->
    <script src="assets/vendor/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="assets/vendor/jquery.printelement.js" type="text/javascript"></script>

    <script src="assets/vendor/DataTables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/vendor/DataTables/fnReloadAjax.js" type="text/javascript"></script>


    <script src="assets/vendor/JQV/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <!--<script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>-->
    <script src="assets/vendor/jquery.ui.timepicker-0.0.8.js" type="text/javascript"></script>

    <script src="assets/js/uploader.js" type="text/javascript"></script>
    <script src="assets/vendor/ajaxupload/fileuploader.js" type="text/javascript"></script>

    <script type="text/javascript" src="assets/vendor/chosen/chosen.jquery.min.js"></script>
    <script src="assets/vendor/fancybox/source/jquery.fancybox.js"></script>

    <script type="text/javascript" src="assets/vendor/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>

    <script src="assets/js/admin.js?ver=1" type="text/javascript"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                dom: 'Bfrtip',
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                responsive: true,
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "iDisplayLength": 12,
                buttons: [
                    'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $("#example3").DataTable({
                dom: 'Bfrtip',
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                responsive: true,
                "lengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]],
                "iDisplayLength": 5,
                buttons: [
                    'pageLength'
                ]
            });
        });
    </script>
    </html>

@endsection

