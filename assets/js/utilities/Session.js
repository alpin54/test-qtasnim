/* ------------------------------------------------------------------------------
@name: Session
@description: Session
--------------------------------------------------------------------------------- */

// --- Session
var _timeoutSession;
var Session = {
  // --- handleSet
  handleSet: function (key, value) {
    return localStorage.setItem(key, value);
  },

  // --- handleGet
  handleGet: function (key) {
    return localStorage.getItem(key);
  },

  // --- handleRemove
  handleRemove: function (key) {
    return localStorage.removeItem(key);
  },

  // --- handleClear
  handleClear: function () {
    return localStorage.clear();
  },

  // --- handleTimeout
  handleTimeout: function (callbackFunction, timer = 30) {
    var _timeoutSession = setTimeout(function () {
      callbackFunction();
    }, timer * 1000);

    document.addEventListener(
      "mousemove",
      function (e) {
        clearTimeout(_timeoutSession);
        _timeoutSession = setTimeout(function () {
          callbackFunction();
        }, timer * 10000);
      },
      true
    );
  },

  // --- return
  return: function () {
    Session.handleSet();
    Session.handleGet();
    Session.handleRemove();
    Session.handleClear();
    Session.handleTimeout();
  },
};

export default Session;
