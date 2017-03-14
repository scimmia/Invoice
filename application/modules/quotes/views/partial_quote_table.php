<div class="table-responsive">
    <table class="table table-striped">

        <thead>
        <tr>
            <th><?php echo trans('status'); ?></th>
            <th><?php echo trans('quote'); ?></th>
            <th><?php echo trans('created'); ?></th>
            <th style="display: none"><?php echo trans('due_date'); ?></th>
            <th><?php echo trans('client_name'); ?></th>
            <th style="text-align: right; padding-right: 25px;"><?php echo trans('amount'); ?></th>
            <th><?php echo trans('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($quotes as $quote) { ?>
            <tr>
                <td>
                    <span
                        class="label <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>"><?php echo $quote_statuses[$quote->quote_status_id]['label']; ?></span>
                </td>
                <td>
                    <a href="<?php echo site_url('quotes/view/' . $quote->quote_id); ?>"
                       title="<?php echo trans('edit'); ?>">
                        <?php echo($quote->quote_number ? $quote->quote_number : $quote->quote_id); ?>
                    </a>
                </td>
                <td>
                    <?php echo date_from_mysql($quote->quote_date_created); ?>
                </td>
                <td style="display: none">
                    <?php echo date_from_mysql($quote->quote_date_expires); ?>
                </td>
                <td>
                    <a href="<?php echo site_url('clients/view/' . $quote->client_id); ?>"
                       title="<?php echo trans('view_client'); ?>">
                        <?php echo $quote->client_name; ?>
                    </a>
                </td>
                <td style="text-align: right; padding-right: 25px;">
                    <?php echo format_currency($quote->quote_total); ?>
                </td>
                <td>
                    <a class="btn btn-default" href="<?php echo site_url('quotes/view/' . $quote->quote_id); ?>" role="button"><?php echo trans('edit'); ?></a>
                    <a class="btn btn-default" href="<?php echo site_url('quotes/delete/' . $quote->quote_id); ?>" role="button"><?php echo trans('delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>