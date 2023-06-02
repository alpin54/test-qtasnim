/* ------------------------------------------------------------------------------
@name: Date
@description: Date Activate
--------------------------------------------------------------------------------- */

var Date = {
  // --- handleDateRange
  handleDateRange: function (date) {
    return date.replace(" - ", "-").split("-");
  },

  // --- handleFormatDate
  handleFormatDate: function (date) {
    var _date = date.split(/\//);
    return [_date[0], _date[1], _date[2]].join("-");
  },

  return: function () {
    Date.handleDateRange();
    Date.handleFormatDate();
  },
};

export default Date;
