     <!-- Modal -->
		         <!--  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="communities" class="modal fade"> -->
		          <div class="modal fade" id="subcommunities" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">ADD COMMUNITIES</h4>
		                      </div>
		                      
		                      <div class="modal-body">
		                      <form action="eventHandler.php" method="post">
		                          <p>Enter Sub Community Name</p>
		                          <input type="text" name="subcommunity" placeholder="Sub Community" class="form-control" required>
					  <input type="hidden" name="event" value="add_subcommunity">
					  <input type="hidden" id="comid" name="community_id" value=0>
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