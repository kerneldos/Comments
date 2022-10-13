$(document).ready(function () {
    const $dateRange = $('.dateRange');

    $dateRange.daterangepicker({
        'autoUpdateInput': false,
        'autoApply': true,
        'timePicker': true,
        'timePicker24Hour': true,
        'locale': {
            'cancelLabel': 'Clear',
            'format': 'D.M.Y hh:mm',
        }
    });

    $dateRange.on('apply.daterangepicker', function(ev, picker) {
        console.log(picker);
        $(this).val(picker.startDate.format('D.M.Y hh:mm') + ' - ' + picker.endDate.format('D.M.Y hh:mm'));
        $(this).trigger('change');
    });

    $dateRange.on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).trigger('change');
    });
});