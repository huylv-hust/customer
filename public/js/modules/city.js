var city = function () {
    var check_all = function () {
        $(".checkall").click(function () {
            var a = $(".checkall").is(':checked');
            if (a == true) {
                $(".row-check").prop('checked', true);
            }
            else {
                $(".row-check").prop('checked', false);
            }
        });
    };

    var search = function () {
        $('#btn_search').on('click', function () {
            $('#form_manage').attr('method', 'GET').attr('action', baseUrl + '/admin/cities').submit();
        });
    };

    var del = function () {
        $('#btn_delete').on('click', function () {
            if(confirm('Are you sure ?')) {
                $('#form_manage').attr('action', baseUrl + '/admin/cities/delete').attr('method', 'POST').submit();
            }

        });
    };

    return {
        init: function () {
            check_all();
            search();
            del();
        }
    };
}();

$(function () {
    city.init();
});