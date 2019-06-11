@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Question</div>

                <div class="card-body">
                    <form method="POST" action="/questions"> 
                        {{csrf_field()}}
                    <div class="form-group">
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">Choose one</option>
                            @foreach(App\Subject::all() as $subject)
                             <option value="{{$subject->id}}" {{ old('subject_id')==$subject->id ? 'selected' : ''}}>{{$subject->subslug}}</option>
                             @endforeach
                        </select>
                        <input placeholder="Question title here" name="qtitle" type="text" class="form-control" value="{{old('qtitle')}}" required>
                        <textarea placeholder="Question details here" name="qdetails" value="{{old('qdetails')}}" required></textarea>
                        <input placeholder="Question number with part" name="qnop" type="text" class="form-control" value="{{old('qnop')}}" required>
                        <button type="submit"
                        class="btn-primary" required>Post Question</button>
                       </form> 
                       
                       @if (count($errors))
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                             @endforeach
                             </ul>
                       @endif
                       
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
