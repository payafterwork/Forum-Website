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
                        <input placeholder="Question title here" name="qtitle" type="text" class="form-control">
                        <textarea placeholder="Question details here" name="qdetails"></textarea>
                        <input placeholder="Question number with part" name="qnop" type="text" class="form-control">
                        <button type="submit"
                        class="btn-primary">Post Question</button>
                       </form> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
