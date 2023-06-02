var BackButton = {
  // handle back
  handleBack: function () {
    $(".js-back-btn").on("click", function (e) {
      window.history.back();
      e.preventDefault();
    });
  },

  init: function () {
    if ($(".js-back-btn").length) {
      BackButton.handleBack();
    }
  },

  return: function () {
    BackButton.init();
  },
};

export default BackButton;
