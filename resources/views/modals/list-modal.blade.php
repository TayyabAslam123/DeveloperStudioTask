<div class="modal fade" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add A New List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
		<form action="{{url('list')}}" method="POST" id="f1" >
    @csrf
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Enter List Title" id="t1" name="title" required>
    </div>
 
  <button type="submit" class="btn btn-success btn-lg btn-block">ADD NOW</button>
  </form>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>