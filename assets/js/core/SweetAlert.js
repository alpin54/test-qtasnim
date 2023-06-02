/* ------------------------------------------------------------------------------
@name: SweetAlert
@description: SweetAlert Activate
--------------------------------------------------------------------------------- */

var SweetAlert = {
  // handle run detele
  handleRunDelete: function () {
    //Parameter
    $("body").on("click", ".js-delete", function (e) {
      e.preventDefault();
      var url = e.currentTarget.getAttribute("href");
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger m-l-10",
        buttonsStyling: false,
      }).then(
        function () {
          swal({
            title: "Deleted!",
            text: "Your file has been deleted.",
            type: "success",
            timer: 1500
          });
          SweetAlert.handleSuccess(url);
        },
        function (dismiss) {
          if (dismiss === "cancel") {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        }
      );
    });
  },

  // handle success
  handleSuccess: function (url) {
    setTimeout(function () {
      window.location.href = url;
    }, 800);
  },

  init: function () {
    SweetAlert.handleRunDelete();
  },

  return: function () {
    SweetAlert.init();
  },
};

export default SweetAlert;
