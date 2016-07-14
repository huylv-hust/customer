
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

    // var csv = function () {
    //     $("#export").click(function () {
    //         $.ajax({
    //             url: baseUrl+'/admin/export',
    //             type: 'post',
    //             data: {
    //                 'start_date': $("#start_date").val(),
    //                 'end_date': $("#end_date").val(),
    //                 'card_number': $("#card_number").val(),
    //             },
    //             success: function (data) {
    //                 console.log(data);
    //             }
    //         });
    //     });
    // };

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


