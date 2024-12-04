<div class="modal fade" id="ajaxModel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="userprofalldata-full">

          <div class="userprofalldata-iner model-form">
            <h3>Admin Information</h3><br><br>
            <form id="userform">
              <div class="alert alert-danger" id="alert-danger-form">
              </div>
              <div class="alert alert-success" id="alert-success-form">
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="user_name">User Name *</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                  </div>
                </div>
                <!-- <div class="col-sm">
                  <div class="form-group">
                    <label for="contact">Contact *</label>
                    <div class="contnumbset-cov">
                      <h6>+91</h6>
                      <input type="text" class="form-control" id="contact" name="contact" placeholder="">
                    </div>
                  </div>
                </div> -->
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="status">This Account is</label>
                    <select class="js-example-basic-single form-control" name="status" id="status">
                      <option value="Enabled">Active</option>
                      <option value="Disabled">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-group">
                    <label for="status">Select Role</label>
                    <select class="js-example-basic-single form-control" name="role" id="role">
                      <option value="Admin">Users Admin</option>
                      <option value="Credentials">Credentials Admin</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="">Select Permission</label>
                    <select class="js-example-basic-single form-control" name="permission">
                      <option value="">Comming soon</option>
                    </select>
                  </div>
                </div>
              </div> -->
              <br><br>
              <h3>Current User Identity Verification</h3><br>

              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="current_user_password">Password</label>
                    <input type="password" class="form-control" id="current_user_password" name="current_user_password" placeholder="">
                  </div>
                </div>
              </div>
              <input type="hidden" id="admin_id" name="admin_id" value="">
              <div class="saveprofdata">
                <button type="submit" value="Save" id="saveBtn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>