/* ------------------------------------------------------------------------------
@name: Currency
@description: Currency
--------------------------------------------------------------------------------- */

var Currency = {
  idr_format: function (number, prefix = "Rp ") {
    let _number_string = number.toString().replace(/[^,\d]/g, ""),
      _split = _number_string.split(","),
      _mod = _split[0].length % 3,
      _idr = _split[0].substr(0, _mod),
      _thousands = _split[0].substr(_mod).match(/\d{3}/gi),
      _separator = "",
      _result;

    // if thousands
    if (_thousands) {
      _separator = _mod ? "." : "";
      _idr += _separator + _thousands.join(".");
    }

    _idr = _split[1] != undefined ? _idr + "," + _split[1] : _idr;
    _result = prefix != false ? prefix + _idr : _idr;
    return _result;
  },

  // remove_idr_format
  remove_idr_format: function (idr) {
    let _result = idr
      .split(".")
      .join("")
      .split(" ")
      .join("")
      .split("Rp")
      .join("");
    return Number(_result);
  },

  // abbreviate
  abbreviate: function (num, digits) {
    var units = ["k+", "M+", "B+", "T+", "P+", "E+", "Z+", "Y+"],
      decimal;

    for (var i = units.length - 1; i >= 0; i--) {
      decimal = Math.pow(1000, i + 1);

      if (num <= -decimal || num >= decimal) {
        return +(num / decimal).toFixed(digits) + units[i];
      }
    }
    return num;
  },

  return: function () {
    Currency.idr_format();
    Currency.remove_idr_format();
    Currency.abbreviate();
  },
};

export default Currency;
