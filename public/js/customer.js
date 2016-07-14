
var customer = function () {
    var load_districts = function () {
        var request = $.ajax({
            type: 'POST',
            url: baseUrl + '/getDistricts',
            dataType: 'json',
            data : {
                city_id: $('#address_1 option:selected').val()
            }

        }).done(function(result) {
            $('#address_2').select2('val','');
            html = '<option selected="selected" value=""> --- Select District --- </option>';
            $.each(result, function(k, v) {
                    html += '<option value="' + k + '">' + v + '</option>';
            });
            $('#address_2').html(html);
        })
    };

    var change_city = function () {
        $('#address_1').change(function(){
            load_districts();
        });
    };

    return {
        init: function () {
            load_districts();
            change_city();
        }
    };
}();

$(function () {
    customer.init();
});

