<!--SUCCESS/FAILURE MESSAGES-->
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert" >
    {{ Session::get('message') }}
 <a href="#" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
 </a>
</p>
@endif