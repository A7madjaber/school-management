@extends('admin.layouts.master',['title'=>trans('main_trans.Teachers')])
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @include('admin.layouts.errors')

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('admin.teacher.update',$teacher->id)}}" method="Post">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                        <input type="email" value="{{old('Email',$teacher->Email)}}" name="Email" class="form-control">
                                        @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                        <input type="password" name="Password" class="form-control">
                                        @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                        <input type="text" value="{{old('Name_ar',$teacher->getTranslation('Name','ar'))}}" name="Name_ar" class="form-control">
                                        @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                                        <input type="text" value="{{old('Name_en',$teacher->getTranslation('Name','en'))}}" name="Name_en" class="form-control">
                                        @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                            <option value="{{$teacher->Specialization_id}}">{{$teacher->specializations->Name}}</option>
                                            @foreach($specializations as $specialization)


                                                <option value="{{$specialization->id}}" {{$specialization->id == $teacher->specializations->id ?'selected':''}}>{{$specialization->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                            <option  disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($genders as $gender)

                                                <option value="{{$gender->id }}" {{$gender->id == $teacher->gender->id ?'selected':''}} >
                                                    {{trans($gender->Name)}}</option>
                                            @endforeach

                                        </select>
                                        @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" value="{{old('Joining_Date',$teacher->Joining_Date)}}" id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                    <textarea class="form-control" name="Address"
                                              id="exampleFormControlTextarea1" rows="4">{{old('Address',$teacher->Address)}}</textarea>
                                    @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success nextBtn pull-end" type="submit">{{trans('Parent_trans.Next')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

    @endpush
    <!-- row closed -->
@endsection
