
var profile = function () {
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
            html = '<option value=""> --- Select District --- </option>';
            $.each(result, function(k, v) {
                if($('#address2').val() == k) {
                    html += '<option selected value="' + k + '">' + v + '</option>';
                } else {
                    html += '<option value="' + k + '">' + v + '</option>';
                }
            });
            $('#address_2').html(html).select2();
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
    profile.init();
});


