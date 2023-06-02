// --- components
import {
  Type,
  Product,
  Sale,
} from "../components/index.js";

/* ------------------------------------------------------------------------------
@name: DeleteData
@description: DeleteData Activate
--------------------------------------------------------------------------------- */

var DeleteData = {
  handleGetData: function (id) {
    if ($(".js-type-result").length) {
      Type.handleDeleteData(id);
    }
    if ($(".js-product-result").length) {
      Product.handleDeleteData(id);
    }
    if ($(".js-sale-result").length) {
      Sale.handleDeleteData(id);
    }
  },
  // handle run detele
  handleRunDelete: function () {
    //Parameter
    $("body").on("click", ".js-delete-data", function (e) {
      var _id = $(this).attr("data-id");
      swal({
        title: "Apakah Anda yakin?",
        text: "Tindakan ini tidak dapat diurungkan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger m-l-10",
        buttonsStyling: false,
      }).then(
        function () {
          swal({
            title: "Deleted!",
            text: "Data Anda telah dihapus.",
            type: "success",
            timer: 1500,
          });

          DeleteData.handleGetData(_id);
        },
        function (dismiss) {
          if (dismiss === "cancel") {
            swal("Batal", "Data Anda aman :)", "error");
          }
        }
      );
    });
  },

  init: function () {
    DeleteData.handleRunDelete();
  },

  return: function () {
    DeleteData.init();
  },
};

export default DeleteData;
