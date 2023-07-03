"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_init_js"],{

/***/ "./resources/js/components/init.js":
/*!*****************************************!*\
  !*** ./resources/js/components/init.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

window.onload = function (e) {
  window.VacationModalObj = new VacationModal();
  var toastElList = document.querySelectorAll('.toast');
  var toastList = _toConsumableArray(toastElList).map(function (toastEl) {
    return new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Toast(toastEl);
  });
  toastList.forEach(function (toast) {
    return toast.show();
  });
  setTimeout(function () {
    toastList.forEach(function (toast) {
      return toast.hide();
    });
  }, 5000);
};

/***/ })

}]);