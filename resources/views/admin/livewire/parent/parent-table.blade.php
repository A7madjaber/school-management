<button class="btn btn-success  pull-right" wire:click="showFormAdd" type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Name_Father') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.Job_Father') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($my_parents as $my_parent)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->Name_Father }}</td>
                <td>{{ $my_parent->National_ID_Father }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->Phone_Father }}</td>
                <td>{{ $my_parent->Job_Father }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                    <button id="delete" data-route="{{route('admin.parent.delete')}}"
                            title="{{ trans('Grades_trans.Delete') }} "data-id="{{$my_parent->id}}"
                            class="btn btn-danger btn-sm">
                        <i  class="fa fa-trash"></i></button>

                </td>
            </tr>
        @endforeach
    </table>
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
                    text: "بمجرد الحذف ، سيتم حذف هذا نهائيًا!",
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
                    text: "Once deleted, this will be permanently deleted!",
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
