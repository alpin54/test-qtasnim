// --- variables
import { API_URL, WHITESPACE } from "../variables/index.js";

// --- utilities
import {
  FilterData,
  DeleteData,
  Alert,
  Validation,
} from "../utilities/index.js";

/* ------------------------------------------------------------------------------
@name: Sale
@description: Sale
--------------------------------------------------------------------------------- */

// Validation ElementSelector
var ElementSelector = [
  {
    id: "product_id",
    validation: {
      selectRequired: true,
    },
  },
  {
    id: "sold",
    validation: {
      required: true,
    },
  },
];
var ElementEvents = ["input", "blur"];

var Sale = {
  // handleRunValidation
  handleRunValidation: function () {
    Validation.config(ElementEvents, ElementSelector);
  },

  // handleClickValidation
  handleClickValidation: function () {
    $('.js-form-sale button[type="submit"]').on("click", function (e) {
      $.each(ElementSelector, function (i, v) {
        $("#" + v.id).blur();
      });

      if ($(".error").length === 0) {
        var _sold = $('input[name="sold"]').val();
        var _stock = $('input[name="stock"]').val();
        if (Number(_stock) >= Number(_sold)) {
          Sale.handleFormData();
        } else {
          Alert.handleRunAlert('Jumlah melebihi stock!', 'error');
        }
      }
      e.preventDefault();
    });
  },

  // handleGetData
  handleGetData: function (_filter) {
    $.ajax({
      url: API_URL.salePage(_filter.startPage),
      method: "GET",
      dataType: "JSON",
      data: {
        startPage: _filter.startPage,
        limitPage: _filter.limitPage,
        startDate: _filter.startDate,
        endDate: _filter.endDate,
        keyword: _filter.keyword,
      },
      beforeSend: function () {
        var _loader = `<tr>
                        <td colspan="8" class="text-center">
                          <div class="spinner-border text-custom m-2" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </td>
                      </tr>`;
        $(".js-sale-result").html(_loader);
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
              if ($(".js-sale-result").length) {
                _content += `<tr>
                              <td class="text-center">${_number}</td>
                              <td>${v.product_name}</td>
                              <td>${v.type_name}</td>
                              <td>${v.sold}</td>
                              <td>${v.sale_date}</td>
                              <td class="text-center">${v.stock}</td>
                              <td class="text-center">
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-icon btn-primary btn-trans js-edit-data" data-id="${v.sale_id}"><i class="mdi mdi-circle-edit-outline"></i></button>
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-icon btn-danger btn-trans js-delete-data" data-id="${v.sale_id}"><i class="mdi mdi-trash-can-outline"></i></button>
                              </td>
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
          $(".js-sale-result").html(_content);
          $(".js-pagination").html(_pagination);
        }
      },
    });
  },

  // handleDeleteData
  handleDeleteData: function (id) {
    $.ajax({
      url: API_URL.sale,
      method: "DELETE",
      dataType: "JSON",
      data: {
        sale_id: id,
      },
      success: function (response) {
        FilterData.handleLoadData();
      },
    });
  },

  // handlePostData
  handlePostData: function (data, method) {
    $.ajax({
      url: API_URL.sale,
      method: method,
      dataType: "JSON",
      data: data,
      beforeSend: function () {
        var _loader = `<span class="custom-loader"><span></span><span></span><span></span><span></span></span> Mengirim ....`;
        $(".js-form-sale button[type='submit']").html(_loader);
      },
      success: function (response) {
        var _status = response.status;
        var _message = response.message;
        if (_status) {
          $(".js-form-sale button[type='submit']").html(
            `<i class="mdi mdi-content-save-outline"></i> Save`
          );
          $(".modal").modal("hide");
          Sale.handleRemoveData();
          Alert.handleRunAlert(_message);
          setTimeout(function () {
            FilterData.handleLoadData();
          }, 800);
        }
      },
    });
  },

  // handleUpdateData
  handleUpdateData: function () {
    $("body").on("click", ".js-edit-data", function (e) {
      var _sale_id = $(this).attr("data-id");
      $(".modal").modal("show");
      $('input[name="sale_id"]').attr("value", _sale_id);
      $.ajax({
        url: API_URL.sale,
        method: "GET",
        dataType: "JSON",
        data: {
          sale_id: _sale_id,
        },
        success: function (response) {
          var _data = response.data;
          var _status = response.status;
          if (_status) {
            $('input[name="sold"]').val(_data.sold);
            $('input[name="stock"]').attr('value', _data.stock);
            $('select[name="product_id"] option').each(function () {
              if ($(this).val() == _data.product_id) {
                $(this).attr("selected", "selected");
              }
            });
          }
        },
      });
    });
  },

  // handleFormData
  handleFormData: function () {
    var _sale_id = $('input[name="sale_id"]').val();
    var _product_id = $('select[name="product_id"]').val();
    var _sold = $('input[name="sold"]').val();
    var _stock = $('input[name="stock"]').val();
    if (!WHITESPACE.test(_product_id)) {
      if (_sale_id) {
        var _data = {
          sale_id: _sale_id,
          product_id: _product_id,
          sold: _sold,
          stock: _stock,
        };
        Sale.handlePostData(_data, "PUT");
      } else {
        var _data = {
          product_id: _product_id,
          sold: _sold,
          stock: _stock,
        };
        Sale.handlePostData(_data, "POST");
      }
    }
  },

  // handleRemoveData
  handleRemoveData: function () {
    $('select[name="product_id"] option').removeAttr("selected");
    $('select[name="product_id"] option[value="0"]').attr("selected", "selected");
    $('input[name="sold"]').val("");
    $('input[name="stock"]').attr("value", '0');
  },

  // handleResetData
  handleResetData: function () {
    $('button[data-dismiss="modal"]').on("click", function (e) {
      Sale.handleRemoveData();
      $(".js-form-sale").find(".error").removeClass("error");
    });
  },

  // handleSelectProduct
  handleSelectProduct: function () {
    $('.js-select-product').on('change', function() {
      var _product_id = $(this).val();
      $.ajax({
        url: API_URL.product,
        method: "get",
        dataType: "JSON",
        data: {
          product_id: _product_id,
        },
        success: function (response) {
          var _data = response.data;
          $('#stock').attr('value', _data.stock);
        },
      });
    });
  },

  init: function () {
    if ($(".js-form-sale").length) {
      Sale.handleRunValidation();
      Sale.handleClickValidation();
    }
    if ($(".js-sale-result").length) {
      FilterData.init();
      DeleteData.init();
      Sale.handleUpdateData();
      Sale.handleResetData();
    }
    if ($(".js-select-product").length) {
      Sale.handleSelectProduct();
    }
  },

  return: function () {
    Sale.init();
    Sale.handleGetData();
    Sale.handleDeleteData();
  },
};

export default Sale;
