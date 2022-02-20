var Users = function () {


    //********************************************************************************//
    //                            Global variables
    //********************************************************************************//
    var $usersTable = $('#usersTable');


    //********************************************************************************//
    //                            Initializations
    //********************************************************************************//

    var initUsersDatatable = function () {
        $usersTable.DataTable({
            'processing': true,
            'serverSide': true,
            'pageLength': 10,
            'searching': true,
            'lengthChange': true,
            'bInfo': false,
            'autoWidth': true,
            'columnDefs': [
                {
                    'className': 'dt-center',
                    'targets': '_all',
                },
            ],
            columns: [
                {name: 'id', data: 'id', orderable: true},
                {name: 'name', data: 'name', orderable: true},
                {name: 'email', data: 'email', orderable: true},
                {name: 'created_at', data: 'created_at', orderable: true},
                {name: 'action', data: null,orderable: false},
            ],
            'ajax': {
                url: $usersTable.data('url'),
                type: 'get',
                dataType: 'json',
                error: function (error) {
                    toastr.error(error.responseJSON.message);
                },
            },
            'createdRow': function (row, data, index) {
                let date = moment(data.created_at).format('DD-MM-YYYY HH:mm');
                $('td', row).eq(3).empty().append('<span>' + date + '</span>');
                $('td', row).eq(4).empty().append('<span><i style="cursor: pointer" class="delete fa fa-trash" data-id="'+data.id+'" aria-hidden="true"></i></span>');
            },
        });
    };


    //********************************************************************************//
    //                            Events
    //********************************************************************************//

    var reloadDataTable = function () {
        $usersTable.DataTable().ajax.reload();
    }


    var onDeleteClick = function () {
        $usersTable.on( "click",".delete", function( event ) {
            let userId = ($(this).data('id'));
            event.preventDefault();
            $.ajax({
                method : 'DELETE',
                url : deleteUserUrl.replace('id',userId),
            }).done(function (data) {
                reloadDataTable();
                toastr.success(data.message);
            }).fail(function (error) {
                toastr.error(error.responseJSON.message);
            });
        });
    }

    return {
        init: function () {
            initUsersDatatable();
            onDeleteClick();
        }
    };
}();

window.addEventListener('load', function () {
    Users.init();
});
