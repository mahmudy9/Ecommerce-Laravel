

function deletecat(id , url)
{
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    

    $('#modall').modal('show');
    //var url = "{{url('/admin/destroycategory')}}";
    
    $('#delbtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",

            url: url + "/" + id,

            data: {},

            success: function (data) {
                $('#modall').modal('hide');
                $('#' + id).remove();
            },
        });
    });
}


function deletebrand(id, url) {
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $('#modall').modal('show');

    $('#delbtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",

            url: url + "/" + id,

            data: {},

            success: function (data) {
                $('#modall').modal('hide');
                $('#' + id).remove();
            },
        });
    });
}


function deleteproduct(id , url)
{
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#modall').modal('show');

    $('#delbtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",

            url: url + "/" + id,

            data: {},

            success: function (data) {
                $('#modall').modal('hide');
                $('#' + id).remove();
            },
        });
    });
}


function addtocart(id , url)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url : url+"/"+id,

        data: {},

        success: function(data)
                {
            $('#cart').html(data.count);
                }
    })
}