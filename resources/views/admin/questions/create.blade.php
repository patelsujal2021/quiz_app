@extends('layouts.admin.master')

@section('page_title') {{ env('APP_NAME') }} | Questions @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Add New Question</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ route('question.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" placeholder="title" value="@if(old('title')){{old('title')}}@endif"/>
                                @if($errors->has('title'))
                                    <span class="form-text m-b-none text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Correct Answer</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    @for($i=0;$i<4;$i++)
                                        <div class="col-md-6 m-b-md">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <input type="radio" class="form-control" value="{{$i}}" name="correct_answer" />
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="answers[{{$i}}]" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Time Limit</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="time_limit" value="60" min="10" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm m-r-lg" type="submit">Store</button>
                                <a href="{{route('question.index')}}" class="btn btn-white btn-sm">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
