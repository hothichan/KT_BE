$(document).ready(function () {
    function clickDelete() {
        return confirm('bạn muốn xóa thông tin này')
    }
    $("a[data-delete=delete]").click(function() {
        if(clickDelete()) {
            var id = $(this).data('id');
            $.ajax({
                url: 'delete.php',
                type: 'post',
                dataType: 'html',
                data: {
                    id: id
                }
            }).done(function(data) {
                $("#table").html(data);
            })

        }
    })
})