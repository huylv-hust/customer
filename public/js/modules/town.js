
var town = function () {
    var load_districts = function () {
        var request = $.ajax({
            type: 'POST',
            url: baseUrl + '/getDistricts',
            dataType: 'json',
            data : {
                city_id: $('#city_id option:selected').val()
            }

        }).done(function(result) {
            $('#district_id').select2('val','');
            html = '<option value=""> --- Select District --- </option>';
            $.each(result, function(k, v) {
                if($('#district_hidden').val() == k) {
                    html += '<option selected value="' + k + '">' + v + '</option>';
                } else {
                    html += '<option value="' + k + '">' + v + '</option>';
                }
            });
            $('#district_id').html(html).select2();
        })
    };

    var change_city = function () {
        $('#city_id').change(function(){
            load_districts();
        });
    };

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
            $('#form_manage').attr('method', 'GET').attr('action', baseUrl + '/admin/towns').submit();
        });
    };

    var del = function () {
        $('#btn_delete').on('click', function () {
            if(confirm('Are you sure ?')) {
                $('#form_manage').attr('action', baseUrl + '/admin/towns/delete').attr('method', 'POST').submit();
            }

        });
    };

    return {
        init: function () {
            load_districts();
            change_city();
            check_all();
            search();
            del();
        }
    };
}();

$(function () {
    town.init();
});


