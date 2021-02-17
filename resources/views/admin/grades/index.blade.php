@extends('admin.layouts.master',['title'=> trans('Grades_trans.title_page')])


@section('content')

    <h2 class="font-weight-light">{{trans('main_trans.Grades')}}</h2>
<br>
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                   @include('admin.layouts.errors')

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Grades_trans.add_Grade') }}
                    </button>


                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Grades_trans.Name')}}</th>
                                <th>{{trans('Grades_trans.Notes')}}</th>
                                <th>{{trans('Grades_trans.count')}}</th>
                                <th>{{trans('Grades_trans.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($grades as $Grade)
                                <tr>

                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $Grade->name }}</td>
                                    <td>{{ $Grade->notes }}</td>
                                 <td>{{$Grade->classrooms_count}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $Grade->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>

                                        <button id="delete" data-route="{{route('admin.grades.delete')}}"
                                                title="{{ trans('Grades_trans.Delete') }}"data-id="{{$Grade->id}}"
                                                class="btn btn-danger btn-sm">
                                            <i  class="fa fa-trash"></i></button>


                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{route('admin.grades.update')}}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="{{$Grade->id}}">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="Name"
                                                                   class="form-control"
                                                                   value="{{$Grade->getTranslation('name', 'ar')}}"
                                                                   required>


                                                        </div>

                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$Grade->getTranslation('name', 'en')}}"
                                                                   name="Name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $Grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            {{ trans('Grades_trans.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{route('admin.grades.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="Name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="Name_en" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                        <button type="submit"
                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


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

    <!-- row closed -->
@endsection
