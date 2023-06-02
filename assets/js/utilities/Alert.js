/* ------------------------------------------------------------------------------
@name: Alert
@description: Alert Activate
--------------------------------------------------------------------------------- */

var Alert = {
  // handle run delete
  handleRunAlert: function (message, status = "success") {
    if (status == "success") {
      swal({
        title: "Berhasil!",
        text: message,
        type: "success",
        confirmButtonClass: "btn btn-success",
        timer: 1500
      });
    } else if (status == "warning ") {
      swal({
        title: "Peringatan!",
        text: message,
        type: "warning",
        confirmButtonClass: "btn btn-success",
        timer: 1500
      });
    } else {
      swal({
        title: "Gagal!",
        text: message,
        type: "error",
        confirmButtonClass: "btn btn-danger",
        timer: 1500
      });
    }
  },

  return: function () {
    Alert.handleRunAlert();
  },
};

export default Alert;
