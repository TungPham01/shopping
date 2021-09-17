function addToCart(event) {
    event.preventDefault()
    var href = $(this).attr('data-href');
    $.ajax({
        url : href,
        type: 'get',
        success: function (data) {
            if(data.code == 200){
                Swal.fire(
                    'Success!',
                    'Thêm sản phẩm vào giỏ hàng thành công',
                    'success'
                )
                $('.swal2-confirm').click(function () {
                    location.reload()
                });
            }
        },
        error: function (error) {
        }
    })
}

$(function () {
    $('.add-to-cart').click(addToCart)
})