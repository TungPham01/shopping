$(function () {
    $(".tags_select2").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
    $(".category_select2").select2({
        placeholder: "Chọn danh mục",
        allowClear: true
    });

});