<script>
    $(function () {
        $('#save_client_note').click(function () {
            $.post('<?php echo site_url('clients/ajax/save_client_note'); ?>',
                {
                    client_id: $('#client_id').val(),
                    client_note: $('#client_note').val()
                }, function (data) {
                    <?php echo(IP_DEBUG ? 'console.log(data);' : ''); ?>
                    var response = JSON.parse(data);
                    if (response.success == '1') {
                        // The validation was successful
                        $('.control-group').removeClass('error');
                        $('#client_note').val('');

                        $('#notes_list').load("<?php echo site_url('clients/ajax/load_client_notes'); ?>",
                            {
                                client_id: <?php echo $client->client_id; ?>
                            });
                    }
                    else {
                        // The validation was not successful
                        $('.control-group').removeClass('error');
                        for (var key in response.validation_errors) {
                            $('#' + key).parent().parent().addClass('error');
                        }
                    }
                });
        });

    });
</script>

<div id="headerbar">
    <div class="pull-right btn-group">
        <a href="#" class="btn btn-sm btn-default client-create-quote"
           data-client-name="<?php echo $client->client_name; ?>">
            <i class="fa fa-file"></i> <?php echo trans('create_quote'); ?>
        </a>
        <a href="<?php echo site_url('clients/form/' . $client->client_id); ?>"
           class="btn btn-sm btn-default">
            <i class="fa fa-edit"></i> <?php echo trans('edit'); ?>
        </a>

        <a class="btn btn-sm btn-danger"
           href="<?php echo site_url('clients/delete/' . $client->client_id); ?>"
           onclick="return confirm('<?php echo trans('delete_client_warning'); ?>');">
            <i class="fa fa-trash-o"></i> <?php echo trans('delete'); ?>
        </a>
    </div>

</div>


<div id="content" class="tabbable tabs-below">
    <div id="clientDetails" class="tab-pane tab-info active">

        <?php $this->layout->load_view('layout/alerts'); ?>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8">
                <h3><?php echo $client->client_name; ?></h3>
                <br>
                <p>
                    <?php echo ($client->client_phone) ? $client->client_phone . '<br>' : ''; ?>
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <table class="table table-condensed table-bordered">
                    <tr>
                        <th>
                            <?php echo trans('total_billed'); ?>
                        </th>
                        <td class="td-amount">
                            <?php echo format_currency($client->client_invoice_total); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>


        <?php if ($custom_fields) : ?>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h4><?php echo trans('custom_fields'); ?></h4>
                    <br>
                    <table class="table table-condensed table-striped">
                        <?php foreach ($custom_fields as $custom_field) : ?>
                            <tr>
                                <th><?php echo $custom_field->custom_field_label ?></th>
                                <td><?php echo nl2br($client->{$custom_field->custom_field_column}); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <hr>
        <?php echo $quote_table; ?>

        <div>
            <h4><?php echo trans('notes'); ?></h4>
            <br>

            <div id="notes_list">
                <?php echo $partial_notes; ?>
            </div>
            <div class="panel panel-default panel-body">
                <form class="row">
                    <div class="col-xs-12 col-md-10">
                        <input type="hidden" name="client_id" id="client_id"
                               value="<?php echo $client->client_id; ?>">
                        <textarea id="client_note" class="form-control" rows="1"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-2 text-center">
                        <input type="button" id="save_client_note" class="btn btn-default btn-block"
                               value="<?php echo trans('add_notes'); ?>">
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>