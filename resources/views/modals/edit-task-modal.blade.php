	<!-- The Modal -->
	<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">UPDATE TASK</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="#" method="POST" enctype='multipart/form-data' id="edit">
   
    @csrf
    <div class="form-group">
	<label for="comment">Title:</label>		
    <input type="text" class="form-control"  name="title" id="mytask">
</div>
<br>
	<div class="form-group">
  <label for="comment">Description:</label>
  <textarea class="form-control" rows="3" id="mydescription" name="description"></textarea>
</div>
<br>
<label for="comment">Status:</label>		
<br>
<div class="form-check-inline">
      <label class="form-check-label" for="check1">
        <input type="radio" class="form-check-input" id="onstatus" name="status" value="1" >Completed
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="check2">
        <input type="radio" class="form-check-input" id="offstatus" name="status" value="0">Incomplete
      </label>
    </div>

	<br><br>
  <label for="comment" style="color:red;">Only choose a file if you want to update:</label>	
  <br>	
	<Input type="file" name="attachment">
   <Input type="hidden" name="list_id" id="mylist">
    <input type="hidden" name="_method" value="PUT">
    </div>
 
  <button type="submit" class="btn btn-primary btn-lg btn-block">UPDATE NOW</button>
  </form>
       
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>