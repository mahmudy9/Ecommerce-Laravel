

function deletecat(id , url)
{
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

            error: function () {
                $('#modall').modal('hide');
                alert('can\'t delete category it has relations');
            }
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

            error : function()
                    {
                        $('#modall').modal('hide');
                        alert('can\'t delete brand it has relations');                        
                    }
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
                },

        error: function()
                {
                    alert(' max quantity reached ');
                }
    })
}

function destroy_cart_item(id, url)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content') 
        }
    })

    $.ajax({
        type: "POST" ,

        url : url+'/'+id,

        data : {},

        success : function(data)
                    {
                        $('#'+id).remove();
                    }
    })
}


function disapprove(id , url)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST" ,

        url : url + '/' + id,

        data: {},

        success: function(data)
                    {
                        $('#'+id).remove();
                    }
    })

}


function approve_product(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}


function seen(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}



function approve_review(id, url) 
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}


function disapprove_review(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}



function delete_review(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}


function delete_post(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $('#modall').modal('show');

    $('#delbtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",

            url: url+'/'+id,

            data: {},

            success: function (data) {
                $('#modall').modal('hide');
                $('#' + id).remove();
            }
        });
    });
}




function delete_contact(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}



function delete_sub(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    })

    $.ajax({
        type: "POST",

        url: url + '/' + id,

        data: {},

        success: function (data) {
            $('#' + id).remove();
        }
    })

}
