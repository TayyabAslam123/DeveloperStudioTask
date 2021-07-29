@include('includes.loader')
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{asset('custom.css')}}" type="text/css"> 
	 @include('includes.scripts') 
</head>

<body>

	<header class="masthead">
		<div class="logo">
			<h1><i class="fab fa-trello logo-icon" aria-hidden="true"></i>DEVELOPER'S STUDIO TODO LIST</h1> </div>
		</div>
		<div class="user-settings">
			<!--authorization checks-->
			@if(auth()->user()->isadmin==1 or auth()->user()->permission==1 )
			<a class="user-settings-btn btn" aria-label="Create" style="background-color: green;" href="{{url('/list')}}">
				<h4 style="color:white;">MY LIST</h4> </a>
		    @endif		

			@if(auth()->user()->isadmin==1)
			<a class="user-settings-btn btn" aria-label="Create" style="background-color: green;" href="{{url('/user')}}">
				<h4 style="color:white;">USERS</h4> </a>
		    @endif		
			<a class="user-settings-btn btn" aria-label="Create" style="background-color: red;" href="{{url('/logout')}}">
				<h4 style="color:white;">LOGOUT</h4> </a>
		</div>
	</header>
	
	<br>
	<!--authorization checks-->
	@if(auth()->user()->isadmin==1 or auth()->user()->permission==1 )
	<section class="board-info-bar">
		<div class="board-controls">
			<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">
				<h1>+ ADD A NEW LIST</h1> </button>
		</div>
	</section>
	@endif

	<br>
	@include('includes.message')
	<!-- End of board info bar -->
	<!-- Lists container -->
	<section class="lists-container">
		<!--looping through the lists-->
	@foreach($arr as $key=>$value)

		 @php 
		 $temp=(explode("-",$key));
		 @endphp

		<div class="list">
			<h1 class="list-title">{{$temp[1]}}
			<!--authorization checks-->	
			@if(auth()->user()->isadmin==1 or auth()->user()->permission==1 )
				 <button class="btn btn-primary" onclick=addTask({{$temp[0]}})>+ Add New Task</button>
			@endif	
				 <br><hr>
			<!--progress of list-->	 
			   	Completed : {{$temp[2]}}
				<br>
				Incomplete: {{$temp[3]}}
				</h1>
			<ul class="list-items">
		 @foreach($value as $var)
	
		<li>
		<h3 style="{{$var->status==1?'color:green':'color:red'}}">{{$var->title}}</h3>
		<p>{{$var->description}}</p>
		 @if($var->attachment!=null) 
		 <a href="{{Storage::url('public/files/'.$var->attachment)}}" download>Click to download attachment..</a>
		 @endif
		 <!--authorization checks-->
		 @if(auth()->user()->isadmin==1 or auth()->user()->permission==1 )
		<form action="{{ $url.'/'.$var->id }}" method="POST" onsubmit="return confirm('Are you sure, You want to delete?')"> {{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">
		<button class="btn btn-danger">Delete</button>
		</form> <a class="btn btn-warning" href="javascript:void(0)" onclick="editTask({{$var}})">
		Edit</a>
		@endif
		</li>
      @endforeach </ul>
		</div> 
	  @endforeach
	 </div>
	</section>

	<!-- End of lists container -->

	<!----------LIST MODAL----->
	@include('modals.list-modal')
	<!---------LIST MODAL END------>

	<!----------ADD TASK MODAL----->
	@include('modals.task-modal')
	<!----------ADD TASK MODAL END----->


	<script>
	//edit task function	
	function editTask(data) {
		$('#mytask').val(data.title);
		$('#mydescription').val(data.description);
		if(data.status == 1) {
			$('#onstatus').attr('checked', true);
		} else {
			$('#offstatus').attr('checked', true);
		}
		$('#mylist').val(data.list_id);
		var url = "task/" + data.id;
		$("#edit").attr('action', url);
		$('#myModal3').modal('show');
	}
	//add task function
	function addTask(data) {
		var list_id = data;
		$("#list_id").val(list_id);
		$('#myModal2').modal('show');
	}
	</script>


	
	<!----------EDIT TASK MODAL----->
	@include('modals.edit-task-modal')
	<!----------EDIT TASK MODAL----->
</body>
</html