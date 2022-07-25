<?php


function modalFunc($modalId, $modalMessage) { ?>
   <div class="modal fade" id=<?php echo $modalId ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-danger text-center">
            <?php echo $modalMessage ?>
          </div>
          <?php if($modalId === "cleanModal") : ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">NO</button>
                
                <button type="button" class="btn btn-outline-primary mx-auto" onclick="cleanTable()">Yes</button>
              </div>
          <?php else : ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Close</button>
              </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
<?php }


?>