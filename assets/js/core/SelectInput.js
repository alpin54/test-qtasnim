/* ------------------------------------------------------------------------------
@name: SelectInput
@description: SelectInput
--------------------------------------------------------------------------------- */

var SelectInput = {
  // SelectInput
  handleRunSelectInput: function () {
    // SelectInput
    if ($(".js-select-input").parents('.modal').length) {
      $(".js-select-input").select2({
        dropdownParent: $(".modal")
      });
    } else {
      $(".js-select-input").select2();
    }
  },

  init: function () {
    if ($(".js-select-input").length) {
      SelectInput.handleRunSelectInput();
    }
  },

  return: function () {
    SelectInput.init();
  },
};

export default SelectInput;
