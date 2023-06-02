/* ------------------------------------------------------------------------------
@name: Data Table
@description: Data Table Activate
--------------------------------------------------------------------------------- */

var DataTableInit = {
  // run datatable
  handleRunDataTable: function () {
    // data table default
    $(".js-datatable").DataTable({
      responsive: true,
      autoWidth: false,
      stateSave: true,
      pageLength: 10,
    });

    $(".js-datatable-entry").DataTable({
      responsive: true,
      autoWidth: false,
      lengthMenu: [50, 100, 150, 200, 250],
    });

    $(".js-sale-transaction")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        stateSave: true,
        ordering: false,
        bPaginate: false,
        bLengthChange: false,
        bFilter: true,
        bInfo: false,
        buttons: ["csv", "excel"],
      })
      .buttons()
      .container()
      .appendTo(".dataTables_wrapper .col-md-6:eq(0)");
  },

  handleRunTableResponsive: function () {
    $(".js-table-responsive").responsiveTable({
      addDisplayAllBtn: false,
      addFocusBtn: false,
      stickyTableHeader: false,
    });
  },

  init: function () {
    if (
      $(".js-datatable").length ||
      $(".js-sale-transaction").length ||
      $(".js-datatable-entry").length
    ) {
      DataTableInit.handleRunDataTable();
    }

    if ($(".js-table-responsive").length) {
      DataTableInit.handleRunTableResponsive();
    }
  },

  return: function () {
    DataTableInit.init();
  },
};

export default DataTableInit;
