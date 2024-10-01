jQuery(document).ready(function($) {
    $('.page-title-action').after('<a id="export-order-btn" class="button button-primary" style="margin:10px;">Export Order</a>');
    $('#export-order-btn').click(function() {
        const orderId = addExpBtnObj.orderId;
        $.post(addExpBtnObj.ajaxurl, {
            action: 'woeExpoOrderToCsv',
            orderId: orderId
        }, function (response) {
            if (response) {
                const now = new Date();
                const date = `${now.getDate().toString().padStart(2, '0')}-${(now.getMonth() + 1).toString().padStart(2, '0')}-${now.getFullYear()}`;
                const time = `${now.getHours().toString().padStart(2, '0')}-${now.getMinutes().toString().padStart(2, '0')}`;
                const filename = `order_detail_${date}_${time}.csv`;
                const downloadLink = $('<a/>', {
                    href: response.data.csvDataUri,
                    download: filename
                });
                downloadLink.appendTo('body')[0].click();
                downloadLink.remove();
            }
        }, 'json')
    });
});
