<script type="text/javascript">
    $(function () {
        show_fields();

        $('#user_type').change(function () {
            show_fields();
        });

        function show_fields() {
            $('#administrator_fields').hide();
            $('#guest_fields').hide();

            user_type = $('#user_type').val();

            if (user_type == 1) {
                $('#administrator_fields').show();
            }
            else if (user_type == 2) {
                $('#guest_fields').show();
            }
        }

        $("#user_country").select2({
            placeholder: "<?php echo trans('country'); ?>",
            allowClear: true
        });
    });
</script>

<?php if (isset($modal_user_client)) {
    echo $modal_user_client;
} ?>

<form method="post" class="form-horizontal">

    <div id="headerbar">
        <h1><?php echo trans('user_form'); ?></h1>
    </div>

    <div id="content">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

        <div id="userInfo">

            <fieldset>
                <legend><?php echo trans('account_information'); ?></legend>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                        <label><?php echo trans('name'); ?>: </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="user_name" id="user_name" class="form-control"
                               value="<?php echo $this->mdl_users->form_value('user_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                        <label class="control-label">
                            <?php echo trans('company'); ?>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="user_company" id="user_company" class="form-control"
                               value="<?php echo $this->mdl_users->form_value('user_company'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                        <label class="control-label">
                            <?php echo trans('email_address'); ?>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="user_email" id="user_email" class="form-control"
                               value="<?php echo $this->mdl_users->form_value('user_email'); ?>">
                    </div>
                </div>

                <?php if (!$id) { ?>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                            <label class="control-label">
                                <?php echo trans('password'); ?>
                            </label>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="password" name="user_password" id="user_password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                            <label class="control-label">
                                <?php echo trans('verify_password'); ?>
                            </label>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="password" name="user_passwordv" id="user_passwordv" class="form-control">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                            <label>
                                <?php echo trans('change_password'); ?>
                            </label>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo anchor('users/change_password/' . $id, trans('change_password')); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-3 text-right text-left-xs">
                        <label class="control-label">
                            <?php echo trans('user_type'); ?>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <select name="user_type" id="user_type" class="form-control">
                            <option value=""></option>
                            <?php foreach ($user_types as $key => $type) { ?>
                                <option value="<?php echo $key; ?>"
                                        <?php if ($this->mdl_users->form_value('user_type') == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </fieldset>


        </div>

    </div>

</form>