// --- variables
import { API_URL } from "../variables/index.js";

// --- utilities
import {
  Date,
} from "../utilities/index.js";

/* ------------------------------------------------------------------------------
@name: Dashboard
@description: Dashboard
--------------------------------------------------------------------------------- */

var Dashboard = {
  // handleGetData
  handleGetData: function (_filter) {
    $.ajax({
      url: API_URL.dashboardPage(_filter.startPage),
      method: "GET",
      dataType: "JSON",
      data: {
        startPage: _filter.startPage,
        limitPage: _filter.limitPage,
        startDate: _filter.startDate,
        endDate: _filter.endDate,
        type: _filter.type,
        order: _filter.order,
      },
      beforeSend: function () {
        var _loader = `<tr>
                        <td colspan="8" class="text-center">
                          <div class="spinner-border text-custom m-2" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </td>
                      </tr>`;
        $(".js-dashboard-result").html(_loader);
      },
      success: function (response) {
        var _response = response;
        var _data = _response.data.sale_list;
        var _pagination = _response.data.pagination;
        var _row = _response.data.row;
        var _status = _response.status;

        if (_status) {
          var _content = "";
          if (_data.length) {
            $.each(_data, function (i, v) {
              var _number = i + 1;
              if (_row != 1) {
                _number = _row + i + 1;
              }
              if ($(".js-dashboard-result").length) {
                _content += `<tr>
                              <td class="text-center">${_number}</td>
                              <td>${v.product_name}</td>
                              <td>${v.type_name}</td>
                              <td>${v.sold}</td>
                              <td>${v.sale_date}</td>
                              <td class="text-center">${v.stock}</td>
                            </tr>`;
              }
            });
          } else {
            _content += `<tr>
                          <td colspan="8" class="text-center">
                            <span>Data not found</span>
                          </td>
                        </tr>`;
          }
          $(".js-dashboard-result").html(_content);
          $(".js-pagination").html(_pagination);
        }
      },
    });
  },

  // handleChangePage
  handleChangePage: function () {
    $("body").on("click", ".js-pagination a", function (e) {
      e.preventDefault();
      var _startPage = $(this).data("ci-pagination-page");
      var _showPerPage = $(".js-show-per-page").val();
      var _date = $(".js-date-range-picker").val();
      var _dateRange = Date.handleDateRange(_date);
      var _startDate = Date.handleFormatDate(_dateRange[0]);
      var _endDate = Date.handleFormatDate(_dateRange[1]);
      var _type = $(".js-select-type").val();
      var _order = $(".js-select-order").val();
      var _filter = {
        startPage: _startPage,
        limitPage: _showPerPage,
        startDate: _startDate,
        endDate: _endDate,
        type: _type,
        order: _order,
      };

      Dashboard.handleGetData(_filter);
    });
  },

  // handleFilterData
  handleFilterData: function () {
    $(".js-filter-data").on("click", function () {
      Dashboard.handleLoadData();
    });
  },

  // handleResetData
  handleResetData: function () {
    $(".js-reset-data").on("click", function () {
      var _dateRange = $(".js-date-range-picker").attr('data-date');
      $(".js-show-per-page").val("10");
      $(".js-date-range-picker").val(_dateRange);
      $(".js-select-type").val('All');
      $(".js-select-order").val('All');
      $('.js-select-type option[value="0"]').attr("selected", "selected");
      Dashboard.handleLoadData();
    });
  },

  // handleLoadData
  handleLoadData: function () {
    if ($(".js-pagination a").data("ci-pagination-page") !== undefined) {
      var _startPage = $(".js-pagination a").data("ci-pagination-page");
    } else {
      var _startPage = 1;
    }
    // paging
    var _showPerPage = $(".js-show-per-page").val();

    // date range
    var _date = $(".js-date-range-picker").val();
    var _dateRange = Date.handleDateRange(_date);
    var _startDate = Date.handleFormatDate(_dateRange[0]);
    var _endDate = Date.handleFormatDate(_dateRange[1]);

    // type
    var _type = $(".js-select-type").val();
    // order
    var _order = $(".js-select-order").val();

    var _filter = {
      startPage: _startPage,
      limitPage: _showPerPage,
      startDate: _startDate,
      endDate: _endDate,
      type: _type,
      order: _order,
    };
    console.log(_filter);

    Dashboard.handleGetData(_filter);
  },

  init: function () {
    if ($(".js-dashboard-result").length) {
      Dashboard.handleChangePage();
      Dashboard.handleFilterData();
      Dashboard.handleResetData();
      Dashboard.handleLoadData();
    }
  },

  return: function () {
    Dashboard.init();
  },
};

export default Dashboard;
