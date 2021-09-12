function actionDelete(e) {
    e.preventDefault();
    var eThis = $(this)
    var urlRequest = eThis.data('url');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: urlRequest,
                type: 'get',
                success: function (data) {
                    if(data.code == 200){
                        eThis.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $('.swal2-confirm').click(function () {
                            location.reload()
                        })
                    }
                },
                error: function (error) {
                    console.log(error.responseJSON)
                    if(error.responseJSON.code == 500){
                        Swal.fire(
                            'Error!',
                            'Error, please try again',
                            'error'
                        )
                    }
                }
            })

        }
    })
}


$(function () {
    $(document).on('click','.action_delete',actionDelete)
})