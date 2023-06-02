// --- variables
import { WHITESPACE } from "../variables/index.js";

// --- utilities
import {
  Date,
} from "../utilities/index.js";

// --- components
import {
  Type,
  Product,
  Sale,
} from "../components/index.js";

/* ------------------------------------------------------------------------------
@name: FilterData
@description: FilterData
--------------------------------------------------------------------------------- */

var FilterData = {

  handleGetData: function (_filter) {
    if ($(".js-type-result").length) {
      Type.handleGetData(_filter);
    }
    if ($(".js-product-result").length) {
      Product.handleGetData(_filter);
    }
    if ($(".js-sale-result").length) {
      Sale.handleGetData(_filter);
    }
  },

  handleChangePage: function () {
    $("body").on("click", ".js-pagination a", function (e) {
      e.preventDefault();
      var _startPage = $(this).data("ci-pagination-page");
      var _showPerPage = $(".js-show-per-page").val();
      var _keyword = $(".js-keyword").val();
      var _filter = {
        startPage: _startPage,
        limitPage: _showPerPage,
        keyword: _keyword,
      };

      FilterData.handleGetData(_filter);
    });
  },

  handleFilterData: function () {
    $(".js-filter-data").on("click", function () {
      if ($(".js-date-range-picker").length) {
        FilterData.handleLoadData();
      } else {
        if (!WHITESPACE.test($(".js-keyword").val())) {
          FilterData.handleLoadData();
        }
      }
    });
  },

  handleKeyupKeyword: function () {
    $(".js-keyword").on("keyup", function (e) {
      if (e.which == 13 && !WHITESPACE.test($(this).val())) {
        if ($(".js-pagination a").data("ci-pagination-page") !== undefined) {
          var _startPage = $(".js-pagination a").data("ci-pagination-page");
        } else {
          var _startPage = 1;
        }
        var _showPerPage = $(".js-show-per-page").val();
        var _keyword = $(this).val();

        var _filter = {
          startPage: _startPage,
          limitPage: _showPerPage,
          keyword: _keyword,
        };

        FilterData.handleGetData(_filter);
      }
    });
  },

  handleResetData: function () {
    $(".js-reset-data").on("click", function () {
      var _dateRange = $(".js-date-range-picker").attr('data-date');
      $(".js-show-per-page").val("10");
      $(".js-keyword").val("");
      if ($(".js-date-range-picker").length) {
        $(".js-date-range-picker").val(_dateRange);
      }

      FilterData.handleLoadData();
    });
  },

  // handleLoadData
  handleLoadData: function () {
    if ($(".js-pagination a").data("ci-pagination-page") !== undefined) {
      var _startPage = $(".js-pagination a").data("ci-pagination-page");
    } else {
      var _startPage = 1;
    }
    var _showPerPage = $(".js-show-per-page").val();
    var _keyword = $(".js-keyword").val() !== "" ? $(".js-keyword").val() : 0;

    var _filter = {
      startPage: _startPage,
      limitPage: _showPerPage,
      keyword: _keyword,
    };

    if ($(".js-date-range-picker").length) {
      var _date = $(".js-date-range-picker").val();
      var _dateRange = Date.handleDateRange(_date);
      var _startDate = Date.handleFormatDate(_dateRange[0]);
      var _endDate = Date.handleFormatDate(_dateRange[1]);

      // filter join
      var _filter1 = _filter;
      var _filter2 = {
        startDate: _startDate,
        endDate: _endDate,
      };

      var _filter = {
        ..._filter1,
        ..._filter2,
      };
    }

    FilterData.handleGetData(_filter);
  },

  init: function () {
    FilterData.handleChangePage();
    FilterData.handleFilterData();
    FilterData.handleKeyupKeyword();
    FilterData.handleResetData();
    FilterData.handleLoadData();
  },

  return: function () {
    FilterData.init();
    FilterData.handleLoadData();
  },
};

export default FilterData;
