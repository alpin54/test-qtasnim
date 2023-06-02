// --- core
import {
  DataTableInit,
  SweetAlert,
  TemporaryAlert,
  BackButton,
  DatePickerInput,
  SelectInput,
} from "./core/index.js";

// --- components
import {
  Dashboard,
  Type,
  Product,
  Sale,
} from "./components/index.js";

var App = {
  ready: function () {
    // -- core initialization
    DataTableInit.init();
    SweetAlert.init();
    TemporaryAlert.init();
    BackButton.init();
    DatePickerInput.init();
    SelectInput.init();

    // -- components initialization
    Dashboard.init();
    Type.init();
    Product.init();
    Sale.init();
  },

  init: function () {
    App.ready();
  },
};

App.init();
