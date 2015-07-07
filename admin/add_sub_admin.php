     <!-- Modal -->
		         <!--  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="communities" class="modal fade"> -->
		          <div class="modal fade" id="sub_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">ADD SUB ADMIN</h4>
		                      </div>
		                      
		                      <div class="modal-body">
		                      <form action="eventHandler.php" method="post">
		                   <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required/>
						</div>
					
					<div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
					</div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required/>
                    </div>
		        
		                 <input type="hidden" name="admin_type" value="2">
						<input type="hidden" name="event" value="create_user">
						<input type="hidden" name="redirect" value="sub_admin.php">
		                      
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit"></i>Submit</button>
		                      </div>
		                      </form>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->