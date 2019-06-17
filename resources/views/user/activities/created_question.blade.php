<div class="card-body">

                This Q was published {{$activity->reason->created_at->diffforHumans()}} by <a href="#">{{$activity->reason->creator->name}}</a> and currently has {{$activity->reason->answers_count}}
                     {{str_plural('answer',$activity->reason->answers_count)}}  
                
                    <div class="card- header">{{$activity->reason->creator->name}} asked
                    <h3>{{$activity->reason->qnop}}<h3><a href="{{$activity->reason->path()}}">{{$activity->reason->qtitle}}</a></h4>
                     <p>{{$activity->reason->qdetails}}</p>
                     <hr>
                    </h3>
                    </div>
             </div>
           