/* ------------------------------------------------------------------------------
@name: API_URL
@description: API_URL
--------------------------------------------------------------------------------- */

var URL_BASE = $("base").attr("href");

export var API_URL = {
  // dashboard API endpoint
  dashboardPage: function (page) {
    return `${URL_BASE}v1/dashboard/${page}`;
  },
  // type API endpoint
  type: `${URL_BASE}v1/type`,
  typePage: function (page) {
    return `${URL_BASE}v1/type/${page}`;
  },
  // product API endpoint
  product: `${URL_BASE}v1/product`,
  productPage: function (page) {
    return `${URL_BASE}v1/product/${page}`;
  },
  // sale API endpoint
  sale: `${URL_BASE}v1/sale`,
  salePage: function (page) {
    return `${URL_BASE}v1/sale/${page}`;
  },
};
