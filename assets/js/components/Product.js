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
@name: product
@description: product
--------------------------------------------------------------------------------- */

// Validation ElementSelector
var ElementSelector = [
  {
    id: "product_name",
    validation: {
      required: true,
    },
  },
  {
    id: "product_type",
    validation: {
      selectRequired: true,
    },
  },
  {
    id: "stock",
    validation: {
      required: true,
    },
  },
];
var ElementEvents = ["input", "blur"];

var Product = {
  // handleRunValidation
  handleRunValidation: function () {
    Validation.config(ElementEvents, ElementSelector);
  },

  // handleClickValidation
  handleClickValidation: function () {
    $('.js-form-product button[type="submit"]').on("click", function (e) {
      $.each(ElementSelector, function (i, v) {
        $("#" + v.id).blur();
      });

      if ($(".error").length === 0) {
        Product.handleFormData();
      }
      e.preventDefault();
    });
  },

  // handleGetData
  handleGetData: function (_filter) {
    $.ajax({
      url: API_URL.productPage(_filter.startPage),
      method: "GET",
      dataType: "JSON",
      data: {
        startPage: _filter.startPage,
        limitPage: _filter.limitPage,
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
        $(".js-product-result").html(_loader);
      },
      success: function (response) {
        var _response = response;
        var _data = _response.data.product_list;
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
              if ($(".js-product-result").length) {
                _content += `<tr>
                              <td class="text-center">${_number}</td>
                              <td>${v.product_name}</td>
                              <td>${v.type_name}</td>
                              <td class="text-center">${v.stock}</td>
                              <td class="text-center">
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-icon btn-primary btn-trans js-edit-data" data-id="${v.product_id}"><i class="mdi mdi-circle-edit-outline"></i></button>
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-icon btn-danger btn-trans js-delete-data" data-id="${v.product_id}"><i class="mdi mdi-trash-can-outline"></i></button>
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
          $(".js-product-result").html(_content);
          $(".js-pagination").html(_pagination);
        }
      },
    });
  },

  // handleDeleteData
  handleDeleteData: function (id) {
    $.ajax({
      url: API_URL.product,
      method: "DELETE",
      dataType: "JSON",
      data: {
        product_id: id,
      },
      success: function (response) {
        FilterData.handleLoadData();
      },
    });
  },

  // handlePostData
  handlePostData: function (data, method) {
    $.ajax({
      url: API_URL.product,
      method: method,
      dataType: "JSON",
      data: data,
      beforeSend: function () {
        var _loader = `<span class="custom-loader"><span></span><span></span><span></span><span></span></span> Mengirim ....`;
        $(".js-form-product button[type='submit']").html(_loader);
      },
      success: function (response) {
        var _status = response.status;
        var _message = response.message;
        if (_status) {
          $(".js-form-product button[type='submit']").html(
            `<i class="mdi mdi-content-save-outline"></i> Save`
          );
          $(".modal").modal("hide");
          Product.handleRemoveData();
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
      var _product_id = $(this).attr("data-id");
      $(".modal").modal("show");
      $('input[name="product_id"]').attr("value", _product_id);
      $.ajax({
        url: API_URL.product,
        method: "GET",
        dataType: "JSON",
        data: {
          product_id: _product_id,
        },
        success: function (response) {
          var _data = response.data;
          var _status = response.status;
          if (_status) {
            $('input[name="product_name"]').val(_data.product_name);
            $('input[name="stock"]').val(_data.stock);
            $('select[name="product_type"] option').each(function () {
              if ($(this).val() == _data.product_type) {
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
    var _product_id = $('input[name="product_id"]').val();
    var _product_name = $('input[name="product_name"]').val();
    var _product_type = $('select[name="product_type"]').val();
    var _stock = $('input[name="stock"]').val();
    if (!WHITESPACE.test(_product_name)) {
      if (_product_id) {
        var _data = {
          product_id: _product_id,
          product_name: _product_name,
          product_type: _product_type,
          stock: _stock,
        };
        Product.handlePostData(_data, "PUT");
      } else {
        var _data = {
          product_name: _product_name,
          product_type: _product_type,
          stock: _stock,
        };
        Product.handlePostData(_data, "POST");
      }
    }
  },

  // handleRemoveData
  handleRemoveData: function () {
    $('input[name="product_id"]').val("");
    $('input[name="product_name"]').val("");
    $('select[name="product_type"] option').removeAttr("selected");
    $('select[name="product_type"] option[value="0"]').attr("selected", "selected");
    $('input[name="stock"]').val("");
  },

  // handleResetData
  handleResetData: function () {
    $('button[data-dismiss="modal"]').on("click", function (e) {
      Product.handleRemoveData();
      $(".js-form-product").find(".error").removeClass("error");
    });
  },

  init: function () {
    if ($(".js-form-product").length) {
      Product.handleRunValidation();
      Product.handleClickValidation();
    }
    if ($(".js-product-result").length) {
      FilterData.init();
      DeleteData.init();
      Product.handleUpdateData();
      Product.handleResetData();
    }
  },

  return: function () {
    Product.init();
    Product.handleGetData();
    Product.handleDeleteData();
  },
};

export default Product;
