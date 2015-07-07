     <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="occupation" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">ADD OCCUPATION</h4>
		                      </div>
		                      <form action="eventHandler.php" method="post">
		                      <div class="modal-body">
		                          <p>Enter Occupation</p>
		                          <input type="text" name="occupation" placeholder="Occupation" autocomplete="off" class="form-control placeholder-no-fix">
					  <input type="hidden" name="event" value="add_occupation">
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit">Submit</button>
		                      </div>
		                      </form>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->