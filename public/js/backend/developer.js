const deleteModal = function(route, id) {
    Swal.fire({
        title: 'Are you sure to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function(response) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
};
const approveModal = function(route, id) {
    Swal.fire({
        title: 'Are you sure to approve?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function(response) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
};
const rejectModal = function(route, id) {
    Swal.fire({
        title: 'Are you sure to reject?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        input: 'textarea',
        inputPlaceholder: 'Enter your remarks here...',
        inputAttributes: {
            maxlength: 200
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reject it!',
        cancelButtonText: 'Cancel',
        preConfirm: (remarks) => {
            if (!remarks) {
                Swal.showValidationMessage('Remarks are required!');
            }
            return remarks;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const remarks = result.value;
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                    remarks: remarks
                },
                success: function(response) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    console.error(error);
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong. Please try again.",
                        icon: "error"
                    });
                }
            });
        }
    });
};


const changeStatus = function(route, id) {
    const isChecked = $('.tgl-flip').prop('checked');
    const status = isChecked ? 1 : 2;

    $.ajax({
        url: route,
        type: 'POST',
        data: {
            id: id,
            status: status,
            _token: APP_TOKEN
        },
        success: function(response) {
            if(response.success) {
                toastr.success('Status Updated Successfully.', 'Success');
            }
        },
        error: function() {
            toastr.error('Can Not Update Status.', 'Error');
        }
    });
};
