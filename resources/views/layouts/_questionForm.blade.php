@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" type="text"
           name="title" id="question-title" value="{{old('title', $question->title)}}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif

</div>
<div class="form-group">
    <label for="question-body">Explain your question</label>
    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" name="body"
              id="question-body" rows="10">{{old('body', $question->body)}}</textarea>

    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-lg btn-outline-primary">{{$buttonText}}</button>
</div>

