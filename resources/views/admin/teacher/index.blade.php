@extends('admin.layouts.master',['title'=> trans('main_trans.Teachers')])

@section('content')

    <h2 class="font-weight-light">{{trans('main_trans.Teachers')}}</h2>
    <br>
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{route('admin.teacher.create')}}" class="btn btn-success " role="button"
                       aria-pressed="true">{{ trans('Teacher_trans.Add_Teacher') }}</a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
                                <th>{{trans('Teacher_trans.Gender')}}</th>
                                <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                                <th>{{trans('Teacher_trans.specialization')}}</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $Teacher)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$Teacher->Name}}</td>
                                    <td>{{@$Teacher->gender->Name}}</td>
                                    <td>{{$Teacher->Joining_Date}}</td>
                                    <td>{{@$Teacher->specializations->Name}}</td>
                                    <td>
                                        <a href="{{route('admin.teacher.edit',$Teacher->id)}}"
                                           class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i></a>

                                        <button id="delete" data-route="{{route('admin.teacher.delete')}}"
                                                title="{{ trans('Teacher_trans.Delete_Teacher') }}"data-id="{{$Teacher->id}}"
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i></button>

                                    </td>
                                </tr>

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    @push('js')
        <script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>


        @if (App::getLocale() == 'ar')
            <script>

                $(document).on("click", "#delete", function(e){

                    e.preventDefault();
                    var id =  $(this).attr('data-id');
                    var route =  $(this).attr('data-route');


                    swal({

                        title: "هل انت متأكد من الحذف",
                        text: "بمجرد الحذف ، سيتم حذف الفصول التابعة لهذه المرحلة!",
                        icon: "warning",
                        buttons: ["الغاء", "حذف"],

                        dangerMode: true,
                    })
                        .then((willDelete) => {

                            if (willDelete) {

                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        'id' :id,
                                    },
                                    url: route,
                                    type: "post",
                                    dataType: "JSON",
                                    success : function(data)
                                    {
                                        swal({

                                            text: data.message,
                                            icon: "success",
                                            buttons:  "موافق",
                                        });


                                        $('#datatable').load(document.URL +  ' #datatable');
                                    },
                                })

                            } else {
                                swal({

                                    title: "لم يتم الحذف",
                                    icon: "info",
                                    buttons:  "موافق",
                                })
                            }
                        });
                });
            </script>

        @else

            <script>

                $(document).on("click", "#delete", function(e){

                    e.preventDefault();
                    var id =  $(this).attr('data-id');
                    var route =  $(this).attr('data-route');


                    swal({

                        title: "Are you sure to delete?",
                        text: "Once deleted, the classes for this grade will be deleted!",                            icon: "warning",
                        buttons: ["cancel", "delete"],

                        dangerMode: true,
                    })
                        .then((willDelete) => {

                            if (willDelete) {

                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        'id' :id,
                                    },
                                    url: route,
                                    type: "post",
                                    dataType: "JSON",
                                    success : function(data)
                                    {
                                        swal({

                                            text: data.message,
                                            icon: "success",
                                            buttons:  "ok",
                                        });


                                        $('#datatable').load(document.URL +  ' #datatable');
                                    },
                                })

                            } else {
                                swal({

                                    title: "Not deleted",
                                    icon: "info",
                                    buttons:  "ok",
                                })
                            }
                        });
                });
            </script>
        @endif



    @endpush
@endsection
