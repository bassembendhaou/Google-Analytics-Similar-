/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/visitors.js ***!
  \**********************************/
var Visitors = function () {
  //********************************************************************************//
  //                            Global variables
  //********************************************************************************//
  var $visitsTable = $('#visitsTable');
  var $deviceTypeSelect = $('#deviceType'); //********************************************************************************//
  //                            Initializations
  //********************************************************************************//

  var initVisitsDatatable = function initVisitsDatatable() {
    $visitsTable.DataTable({
      'processing': true,
      'serverSide': true,
      'pageLength': 10,
      'searching': true,
      'lengthChange': true,
      'bInfo': false,
      'autoWidth': true,
      'columnDefs': [{
        'className': 'dt-center',
        'targets': '_all'
      }],
      columns: [{
        name: 'id',
        data: 'id',
        orderable: true
      }, {
        name: 'user',
        data: null,
        orderable: false
      }, {
        name: 'url',
        data: 'url',
        orderable: true
      }, {
        name: 'ip',
        data: 'ip',
        orderable: true
      }, {
        name: 'country',
        data: 'country',
        orderable: true
      }, {
        name: 'device_name',
        data: 'device_name',
        orderable: false
      }, {
        name: 'browser',
        data: 'browser',
        orderable: true
      }, {
        name: 'created_at',
        data: 'created_at',
        orderable: true
      }, {
        name: 'action',
        data: null,
        orderable: false
      }],
      'ajax': {
        url: $visitsTable.data('url'),
        type: 'get',
        dataType: 'json',
        data: function data(d) {
          d.device_type = $deviceTypeSelect.val();
        },
        error: function error(_error) {
          toastr.error(_error.responseJSON.message);
        }
      },
      'createdRow': function createdRow(row, data, index) {
        var date = moment(data.created_at).format('DD-MM-YYYY HH:mm');
        $('td', row).eq(1).empty().append('<span>' + data.user ? data.user.name : 0);
        $('td', row).eq(7).empty().append('<span>' + date + '</span>');
        $('td', row).eq(8).empty().append('<span><i style="cursor: pointer" class="delete fa fa-trash" data-id="' + data.id + '" aria-hidden="true"></i></span>');
      }
    });
  };
  /*    var initUsersSelect = function(){
          $(".users").select2({
              ajax: {
                  url: usersUrl,
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                      return {
                          results: data.items,
                      };
                  },
                  cache: true
              },
              minimumInputLength: 3,
          });
      }*/
  //********************************************************************************//
  //                            Events
  //********************************************************************************//


  var reloadDataTable = function reloadDataTable() {
    $visitsTable.DataTable().ajax.reload();
  };

  var onDeleteClick = function onDeleteClick() {
    $visitsTable.on("click", ".delete", function (event) {
      var visitId = $(this).data('id');
      event.preventDefault();
      $.ajax({
        method: 'DELETE',
        url: deleteVisitUrl.replace('id', visitId)
      }).done(function (data) {
        reloadDataTable();
        toastr.success(data.message);
      }).fail(function (error) {
        toastr.error(error.responseJSON.message);
      });
    });
  };

  var onDeviceTypeChange = function onDeviceTypeChange() {
    $deviceTypeSelect.on('change', function (event) {
      event.preventDefault();
      reloadDataTable();
    });
  };

  return {
    init: function init() {
      initVisitsDatatable();
      initUsersSelect();
      onDeleteClick();
      onDeviceTypeChange();
    }
  };
}();

window.addEventListener('load', function () {
  Visitors.init();
});
/******/ })()
;