<?php


function modalFunc($modalMessage) { ?>
   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-danger text-center">
            <?php echo $modalMessage ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<?php }


?>