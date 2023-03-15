@extends('layouts.admin.master')

@section('page_title') {{ env('APP_NAME') }} | Questions @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Question</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ route('question.update',$question->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" placeholder="title" value="@if(old('title')){{old('title')}}@else{{$question->title}}@endif"/>
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
                                    @foreach($question->answers as $key => $a)
                                    <div class="col-md-6 m-b-md">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <input type="radio" class="form-control" value="{{$a->id}}" name="correct_answer" @if($a->id == $question->correct_answer) checked="" @endif />
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="answers[{{$a->id}}]" value="{{$a->title}}" />
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Time Limit</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="time_limit" value="{{$question->time_limit}}" min="10" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm m-r-lg" type="submit">Update</button>
                                <a href="{{route('question.index')}}" class="btn btn-white btn-sm">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
