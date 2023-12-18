$(document).ready(function () {
    $('.status-dropdown').change(function () {
      
        var taskId = $(this).data('task-id');
        var newStatus = $(this).val();

        $.ajax({
            url: '/tasks/update-status',
            type: 'POST',
            data: {
                taskId: taskId,
                status: newStatus,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);

                $('#success-message').text('Task status updated successfully.');
                $('#success-message').show().delay(4000).fadeOut();
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});