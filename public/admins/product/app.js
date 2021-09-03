$(function () {
    $(".tags_select2").select2({
        tags: true,
        tokenSeparators: [',', '.']
    });
    $(".category_select2").select2({
        placeholder: "Chọn danh mục",
        allowClear: true
    });
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('my_editor', options);
});