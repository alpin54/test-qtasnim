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
@name: type
@description: type
--------------------------------------------------------------------------------- */

// Validation ElementSelector
var ElementSelector = [
  {
    id: "type_name",
    validation: {
      required: true,
    },
  },
];
var ElementEvents = ["input", "blur"];

var Type = {
  // handleRunValidation
  handleRunValidation: function () {
    Validation.config(ElementEvents, ElementSelector);
  },

  // handleClickValidation
  handleClickValidation: function () {
    $('.js-form-type button[type="submit"]').on("click", function (e) {
      $.each(ElementSelector, function (i, v) {
        $("#" + v.id).blur();
      });

      if ($(".error").length === 0) {
        Type.handleFormData();
      }
      e.preventDefault();
    });
  },

  // handleGetData
  handleGetData: function (_filter) {
    $.ajax({
      url: API_URL.typePage(_filter.startPage),
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
        $(".js-type-result").html(_loader);
      },
      success: function (response) {
        var _response = response;
        var _data = _response.data.type_list;
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
              if ($(".js-type-result").length) {
                _content += `<tr>
                              <td class="text-center">${_number}</td>
                              <td>${v.type_name}</td>
                              <td class="text-center">
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-icon btn-primary btn-trans js-edit-data" data-id="${v.type_id}"><i class="mdi mdi-circle-edit-outline"></i></button>
                                <button type="button" data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-icon btn-danger btn-trans js-delete-data" data-id="${v.type_id}"><i class="mdi mdi-trash-can-outline"></i></button>
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
          $(".js-type-result").html(_content);
          $(".js-pagination").html(_pagination);
        }
      },
    });
  },

  // handleDeleteData
  handleDeleteData: function (id) {
    $.ajax({
      url: API_URL.type,
      method: "DELETE",
      dataType: "JSON",
      data: {
        type_id: id,
      },
      success: function (response) {
        FilterData.handleLoadData();
      },
    });
  },

  // handlePostData
  handlePostData: function (data, method) {
    $.ajax({
      url: API_URL.type,
      method: method,
      dataType: "JSON",
      data: data,
      beforeSend: function () {
        var _loader = `<span class="custom-loader"><span></span><span></span><span></span><span></span></span> Mengirim ....`;
        $(".js-form-type button[type='submit']").html(_loader);
      },
      success: function (response) {
        var _status = response.status;
        var _message = response.message;
        if (_status) {
          $(".js-form-type button[type='submit']").html(
            `<i class="mdi mdi-content-save-outline"></i> Save`
          );
          $(".modal").modal("hide");
          Type.handleRemoveData();
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
      var _type_id = $(this).attr("data-id");
      $(".modal").modal("show");
      $('input[name="type_id"]').attr("value", _type_id);
      $.ajax({
        url: API_URL.type,
        method: "GET",
        dataType: "JSON",
        data: {
          type_id: _type_id,
        },
        success: function (response) {
          var _data = response.data;
          var _status = response.status;
          if (_status) {
            $('input[name="type_name"]').val(_data.type_name);
          }
        },
      });
    });
  },

  // handleFormData
  handleFormData: function () {
    var _type_id = $('input[name="type_id"]').val();
    var _type_name = $('input[name="type_name"]').val();
    if (!WHITESPACE.test(_type_name)) {
      if (_type_id) {
        var _data = {
          type_id: _type_id,
          type_name: _type_name,
        };
        Type.handlePostData(_data, "PUT");
      } else {
        var _data = {
          type_name: _type_name,
        };
        Type.handlePostData(_data, "POST");
      }
    }
  },

  // handleRemoveData
  handleRemoveData: function () {
    $('input[name="type_id"]').val("");
    $('input[name="type_name"]').val("");
  },

  // handleResetData
  handleResetData: function () {
    $('button[data-dismiss="modal"]').on("click", function (e) {
      Type.handleRemoveData();
      $(".js-form-type").find(".error").removeClass("error");
    });
  },

  init: function () {
    if ($(".js-form-type").length) {
      Type.handleRunValidation();
      Type.handleClickValidation();
    }
    if ($(".js-type-result").length) {
      FilterData.init();
      DeleteData.init();
      Type.handleUpdateData();
      Type.handleResetData();
    }
  },

  return: function () {
    Type.init();
    Type.handleGetData();
    Type.handleDeleteData();
  },
};

export default Type;
