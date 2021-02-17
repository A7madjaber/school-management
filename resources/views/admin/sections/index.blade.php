@extends('admin.layouts.master',['title'=>trans('Sections_trans.title_page') ])
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Sections_trans.add_section') }}</a>
                </div>
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @include('admin.layouts.errors')
                        <div class="accordion gray plus-icon round" >
                            @foreach ($grades as $grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                    <div class="acd-des">
                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                    <th>{{ trans('Sections_trans.Status') }}</th>
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($grade->sections as $section)
                                                                    <tr>

                                                                        <td>{{ $loop->index+1 }}</td>
                                                                        <td>{{ $section->name }}</td>
                                                                        <td>{{  @$section->classroom->name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($section->status == 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                               class="btn btn-outline-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#edit{{ $section->id }}">{{ trans('Sections_trans.Edit') }}</a>

                                                                            <button id="delete" data-route="{{route('admin.section.delete')}}"
                                                                                    title="{{ trans('Grades_trans.Delete') }}"data-id="{{$section->id}}"
                                                                                    class="btn btn-outline-danger btn-sm">
                                                                                {{ trans('Sections_trans.Delete') }}
                                                                            </button>

                                                                        </td>
                                                                    </tr>


                                                                    <!--تعديل قسم  -->
                                                                    <div class="modal fade"
                                                                         id="edit{{ $section->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('Sections_trans.edit_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form
                                                                                        action="#"
                                                                                        method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        {{ csrf_field() }}
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_Section_Ar"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->getTranslation('name', 'ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_Section_En"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->getTranslation('name', 'en') }}">
                                                                                                <input id="id"
                                                                                                       type="hidden"
                                                                                                       name="id"
                                                                                                       class="form-control"
                                                                                                       value="{{ $section->id }}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                                                                            <select name="Grade_id"
                                                                                                    class="custom-select"
                                                                                                    onclick="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $grade->id }}">
                                                                                                    {{ $grade->name }}
                                                                                                </option>
                                                                                                @foreach ($grades as $grade)
                                                                                                    <option
                                                                                                        value="{{ $grade->id }}">
                                                                                                        {{ $grade->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                                                                            <select name="Class_id"
                                                                                                    class="custom-select">
                                                                                                <option
                                                                                                    value="{{ $section->classroom->id }}">
                                                                                                    {{ $section->classroom->name }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <div class="form-check">

                                                                                                @if ($section->status == 1)
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        checked
                                                                                                        class="form-check-input "
                                                                                                        name="Status"
                                                                                                        id="exampleCheck1">
                                                                                                @else
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="form-check-input"
                                                                                                        name="Status"
                                                                                                        id="exampleCheck1">
                                                                                                @endif
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="exampleCheck1">{{ trans('Sections_trans.Status') }}</label>
                                                                                            </div>
                                                                                        </div>



                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <!--اضافة قسم جديد -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Sections_trans.add_section') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route('admin.section.store')}}" method="POST">
                                      @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="Name_Section_Ar" class="form-control"
                                                       placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="Name_Section_En" class="form-control"
                                                       placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                                            </div>

                                        </div>
                                        <br>


                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                            <select name="Grade_id" class="custom-select"
                                                    onchange="console.log($(this).val())">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('Sections_trans.Select_Grade') }}
                                                </option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}"> {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                            <select name="Class_id" class="custom-select">

                                            </select>
                                        </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-success">{{ trans('Sections_trans.submit') }}</button>
                                </div>

                                </form>
                            </div>
                        </div>
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
                                text: "بمجرد الحذف ، سيتم الحذف نهائيا!",
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
                                text: "Once deleted, Deletion will be permanently!",
                                icon: "warning",
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


                <script>
                $(document).ready(function () {
                    $('select[name="Grade_id"]').on('change', function () {
                        var Grade_id = $(this).val();
                        if (Grade_id) {
                            $.ajax({
                                url: "{{ URL::to('admin/section/classes') }}/" + Grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="Class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>




        @endpush
        <!-- row closed -->
        @endsection

