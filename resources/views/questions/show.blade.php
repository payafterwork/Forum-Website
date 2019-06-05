@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="card-header"> asked
                    <h3>{{$question->qnop}}<h3><a>{{$question->qtitle}}</a></h4>
                     <p>{{$question->qdetails}}</p>
                     <hr>
                </div>
             
               
        
        </div>
    </div>
</div>
@endsection
