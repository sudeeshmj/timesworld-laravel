<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="deleteForm" method="post">
              <input type="hidden" name="delete_id" id="delete_id" >
                <h6>Are you sure do you want  to delete?</h6>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" id="delete_modal_btn"class="btn btn-sm btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>