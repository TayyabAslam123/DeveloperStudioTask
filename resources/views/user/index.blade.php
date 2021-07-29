@include('includes.loader')
@include('includes.scripts')
<br>
<a href="{{url('/list')}}" class="btn btn-warning btn-block">< GO BACK</a>

<div class="row">
    <div class="col-sm-9">
    <h1>{{$title}}</h1>
    </div>
    <div class="col-sm-3">
    <a href="#addme">
    <button class="btn btn-success">ADD {{$title}}</button>
    </a>
    </div>
</div>

@include('includes.message')



<!--LISTING ALL ENTRIES-->
<div class="table-responsive">    
<table class="table table-striped">
<thead>
     <tr>
         @foreach ($headings as $heading)
          <th scope="col">{{$heading}}</th>          
         @endforeach
         <!--ACTIONS-->
        <th scope="col">Actions</th>     
    </tr>
</thead>
      
<tbody >
  <!--for extracting values in relation ship-->
    @foreach ($values as $value)
    <tr>
       @foreach ($headings as $key=>$paired_value)
       <?php $va = $value->$key; ?>

    <td >{{$va}}</td>
       @endforeach
       
       <!--actions-->
       <td>   
           <!--It wil not delete any entry id $disable is set-->
           @if(!isset($disable))
              <!--DELETE THE ENTRY-->
              <form action="{{ $url.'/'.$value->id }}" method="POST" onsubmit="confirm('Are you sure, You want to delete?')">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-danger btn-circle ">Delete User</button>
              </form>
              <!--END-->
          @endif

       
      </td>
  
  
   </tr>
   @endforeach  
</tbody>
</table>


</div>

 <!--ADDING ENTRY FORM-->
 <hr class="sidebar-divider"> 
 <div class="jumbotron" id="addme">
<h2>ADD {{$title}}</h2>
<form action="{{$url}}" method="POST">
    @csrf
<div class="form-group">
    
    @foreach ($data as $key => $value) 
    <div class='form-group'>
    <label>{{$value['name']}}</label>
    @if($value['type'] == "select")
        <select class='form-control select_box_custom' {!! $value['attrib']!!}>
        @foreach ($value['data'] as $k2 => $dd) 
            <option value='{{$k2}}'>{{$dd}}</option>
        @endforeach
        </select>
    @else
        <input class='form-control' type="{{$value['type']}}" {!! $value['attrib'] !!}>
    @endif
    </div>
@endforeach
    
  </div>

  <button type="submit" class="btn btn-primary btn-lg ">Submit</button>
</form> 
  
 </div>

 <!--END-->


