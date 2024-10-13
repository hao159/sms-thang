<?php
/**
 * page_footer.php
 *
 * Author: pixelcave
 *
 * The footer of each page
 *
 */
?>
            <!-- Footer -->
            <footer class="footer-page clearfix">
                <div class="pull-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a href="mailto:haonh1502@gmail.com" target="_blank">hao.nguyen</a>
                </div>
                <div class="pull-left">
                    <span id="year-copy"></span> &copy; <a href="<?= base_url()?>" target="_blank"><?php echo $template['name'] . ' ' . $template['version']; ?></a>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="change-info-form" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Vital Info</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Username</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?= $this->session->userdata('UserName');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">FullName</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?= $this->session->userdata('FullName');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Phone</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?= $this->session->userdata('Phone');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?= $this->session->userdata('Email');?></p>
                            </div>
                        </div>
                        
                    </fieldset>
                    <fieldset>
                        <legend>Password Update</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-new-password">New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-new-password" name="user-new-password" class="form-control" placeholder="Please choose a complex one..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-confirm-repassword" name="user-confirm-repassword" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->
<script>
    $('#change-info-form').on("submit", function(e){
        e.preventDefault();
        
        let firstPass = document.getElementById("user-new-password");
        let secondPass = document.getElementById("user-confirm-repassword");
        if(isNullorEmpty(firstPass.value)){
            alert_error("Please provide a new password!");
            return;
        }
 
        if (firstPass.value.length < 10) {
            alert_error("New password must be more than 10 characters!");
            return;
        }

        if (firstPass.value !== secondPass.value) {
            alert_error("Confirm password do not match!");
            return;
        }

        $.ajax({
            type: "post",
            url: "/account/changePass",
            data: {
                new : firstPass.value,
                re_type : secondPass.value
            },
            dataType: "json",
            success: function(d){
                $('#modal-user-settings').modal('hide');
                console.log(d);
                console.log(d.status);
                if (d.status == "<?=StatusResponse::_SUCCESS?>") {
                    $.bootstrapGrowl("Your password was successfully changed!",{
                        type: "success",
                        delay: 4000,
                        allow_dismiss: true,
                        width : 'auto'
                    });
                    
                }else if(d.status == "<?= StatusResponse::_ERROR ?>"){
                    $.bootstrapGrowl(d.error,{
                        type: "danger",
                        delay: 4000,
                        allow_dismiss: true,
                        width : 'auto'
                    });
                }else{
                    $.bootstrapGrowl("Opps! We can't change your password, pls contact to help desk.",{
                        type: "danger",
                        delay: time,
                        allow_dismiss: true,
                        width : 'auto'
                    });

                }
            }
        });
    });
</script>
