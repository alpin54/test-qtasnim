/* ------------------------------------------------------------------------------
@name: Temporary Alert
@description: Temporary Alert Activate
--------------------------------------------------------------------------------- */

var TemporaryAlert = {
  // handle run Temporary alert
  handleRunTemporaryAlert: function () {
    setTimeout(function () {
      $(".js-temporary-alert").slideUp(300);
    }, 3000);
    setTimeout(function () {
      $(".js-temporary-alert").remove();
    }, 3350);
  },

  init: function () {
    if ($(".js-temporary-alert").length) {
      TemporaryAlert.handleRunTemporaryAlert();
    }
  },

  return: function () {
    TemporaryAlert.init();
  },
};

export default TemporaryAlert;
