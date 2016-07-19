
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
            $('#address_2').html(html).select2().trigger('change');
        })
    };

    var change_city = function () {
        $('#address_1').change(function(){
            load_districts();
        });
    };

    var change_district = function () {
        $('#address_2').change(function(){
            load_towns();
        });
    };

    var load_towns = function () {
        var request = $.ajax({
            type: 'POST',
            url: baseUrl + '/getTowns',
            dataType: 'json',
            data : {
                district_id: $('#address_2 option:selected').val()
            },
            async: false
        }).done(function(result) {
            $('#address_4').select2('val','');
            html = '<option value=""> --- Select Town --- </option>';
            $.each(result, function(k, v) {
                if($('#address4').val() == k) {
                    html += '<option selected value="' + k + '">' + v + '</option>';
                } else {
                    html += '<option value="' + k + '">' + v + '</option>';
                }
            });
            $('#address_4').html(html).select2();
        })
    };

    return {
        init: function () {
            load_districts();
            change_city();
            change_district();
        }
    };
}();

$(function () {
    profile.init();
});


