@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Editing Answer for Question: <strong>{{$question->title}}</strong></h1>
                            <form method="POST"
                                  action="{{route('questions.answers.update', [$question->id,$answer->id])}}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                            <textarea class="form-control {{$errors->has('body') ? 'in-valid' : ''}}" rows="7"
                                      name="body">{{old('body', $answer->body)}}</textarea>
                                    @if($errors->has('body'))
                                        <div class="invalid-feedback">
                                            <strong>{{$errors->first('body')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-outline-primary">
                                        Update your answer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
