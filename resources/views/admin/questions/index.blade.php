@extends('layouts.admin.master')

@section('page_title') {{ env('APP_NAME') }} | Questions @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Questions</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('question.create') }}" class="btn btn-primary btn-sm">Add New Question</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="80%">Title</th>
                            <th width="10%">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($questions as $key => $q)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $q->title }}</td>
                                <td>
                                    <form action="{{ route('question.destroy',$q->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('question.edit',$q->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No Records</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @include('layouts.components.table_pagination', ['paginator' => $questions])
            </div>
        </div>
    </div>
@endsection
