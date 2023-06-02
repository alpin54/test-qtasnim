/* ------------------------------------------------------------------------------
@name: Validation
@description: Validation
--------------------------------------------------------------------------------- */

// --- variables
import {
  WHITESPACE,
  EMAIL,
  NUMBERIC,
  PHONE_NUMBER,
  PERSON_NAME
} from "../variables/index.js";

var Validation = {

  // - config
  config: function(eventsEl, selectorEl) {
    $.each(eventsEl, function(ie, ve) {
      $.each(selectorEl, function(i, v) {
        $('#'+v.id).on(ve, function(e) {
          var _this = $(e.currentTarget),
          _val = _this.val(),
          _target = _this.attr('data-target'),
          _alertEl = $('#'+_target);
          var _errorMessage;

          // Condition if validation does not error
          _alertEl.removeClass('error');
          _this.parent().removeClass('error');

          // confirmPassword Validation
          if (v.validation.confirmPassword) {
            if (_val !== $('#password').val()) {
              _errorMessage = _alertEl.attr('data-invalid-confirm');
            }
          }

          // Minimum Validation
          if (v.validation.minimum) {
            if (_val.length < v.validation.minimumChar) {
              _errorMessage = _alertEl.attr('data-invalid');
            }
          }

          // Maximum Validation
          if (v.validation.maximum) {
            if (_val.length < v.validation.maximumChar) {
              _errorMessage = _alertEl.attr('data-invalid');
            }
          }

          // Name Validation
          if (v.validation.name) {
            if (!PERSON_NAME.test(_val)) {
              _errorMessage = _alertEl.attr('data-invalid');
            }
          }

          // Email validation
          if (v.validation.email) {
            if (!EMAIL.test(_val)) {
              _errorMessage = _alertEl.attr('data-invalid');
            }
          }

          // Numeric validation
          if (v.validation.phone) {
            if (!PHONE_NUMBER.test(_val)) {
              _errorMessage = _alertEl.attr('data-invalid-phone');
            }
          }

          // Select validation
          if (v.validation.selectRequired) {
            if (_val === '0') {
              _errorMessage = _alertEl.attr('data-req');
            }
          }

          // Required validation
          if (WHITESPACE.test(_val)) {
            _errorMessage = _alertEl.attr('data-req');
          }

          // Error Message
          if (_errorMessage !== undefined) {
            _alertEl.text(_errorMessage);
            _alertEl.addClass('error');
            _this.parent().addClass('error');
          }
        });
      });
    });

    // Return Handle keypress
    Validation.handleKeypress();
  },

  // handleKeypress
  handleKeypress: function () {
    $('.number-only').on('keypress', function(e) {
      var _this = $(e.currentTarget),
      _val = _this.val(),
      _target = _this.attr('data-target'),
      _alertEl = $('#'+_target);
      var _errorMessage;
      if (!NUMBERIC.test(e.key)) {
        _errorMessage = _alertEl.attr('data-invalid')
        _alertEl.text(_errorMessage);
        _alertEl.addClass('error');
        _this.parent().addClass('error');
        // remove error after few second
        setTimeout(function() {
          _alertEl.removeClass('error');
          _this.parent().removeClass('error');
        }, 2000);
        e.preventDefault();
      }
    });
  },

  return: function () {
    Validation.config();
  },

};

export default Validation;
