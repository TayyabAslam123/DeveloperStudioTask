	<!-- The Modal -->
	<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ADD NEW TASK</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="{{url('task')}}" method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="form-group">
	<label for="comment">Title:</label>		
    <input type="text" class="form-control"  name="title" required>
</div>
<br>
	<div class="form-group">
  <label for="comment">Description:</label>
  <textarea class="form-control" rows="3" id="comment" name="description" required></textarea>
</div>
<br>
<label for="comment">Status:</label>		
<br>
<div class="form-check-inline">
      <label class="form-check-label" for="check1">
        <input type="radio" class="form-check-input" id="check1" name="status" value="1" required>Completed
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="check2">
        <input type="radio" class="form-check-input" id="check2" name="status" value="0" required>Incomplete
      </label>
    </div>

	<br><br>
	<Input type="file" name="attachment">

    <Input type="hidden" name="list_id" id="list_id">
    </div>
 
  <button type="submit" class="btn btn-primary btn-lg btn-block">ADD NOW</button>
  </form>
       
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>