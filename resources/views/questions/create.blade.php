@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h1>Ask Question</h1>

                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">
                                    Back to All Questions
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{--Fill in the Question Form--}}
                        <form action="{{route('questions.store')}}" method="POST">
                            @include('layouts._questionForm', ['buttonText'=>'Ask this question'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
