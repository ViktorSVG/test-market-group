"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_vacation_js"],{

/***/ "./resources/js/components/vacation.js":
/*!*********************************************!*\
  !*** ./resources/js/components/vacation.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

window.VacationModal = /*#__PURE__*/function () {
  function _class() {
    _classCallCheck(this, _class);
    var self = this,
      vacationTable = document.querySelector('table.vacations');
    this.dateFrom = null;
    this.dateTo = null;
    this.rowId = null;
    this.btnNewVacation = document.getElementById('new-vacation-btn');
    if (this.btnNewVacation) {
      this.btnNewVacation.addEventListener('click', function () {
        self.dateFrom = null;
        self.dateTo = null;
        self.rowId = null;
      });
    }
    this.modalEl = document.getElementById('vacation-modal');
    if (this.modalEl) {
      this.modalEl.addEventListener('shown.bs.modal', function () {
        self.initDate();
      });
      this.modalEl.querySelector('#form-vacation').addEventListener('submit', function (e) {
        return self.check();
      });
      this.modal = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal('#vacation-modal', {
        keyboard: false
      });
      var from = this.modalEl.querySelector('input[name="date_from"]'),
        to = this.modalEl.querySelector('input[name="date_to"]');
      from.addEventListener('change', function () {
        to.min = this.value;
      });
      to.addEventListener('change', function () {
        from.max = this.value;
      });
    }
    if (vacationTable) {
      vacationTable.addEventListener('click', function (e) {
        if (e.target.nodeName.toLowerCase() !== 'img') return;
        self.rowId = e.target.closest('.vacation').getAttribute('data-id');
        switch (e.target.getAttribute('action')) {
          case 'unapproved':
            self.unapproved();
            break;
          case 'approve':
            self.approve();
            break;
          case 'drop':
            self.confirm.show();
            break;
          case 'edit':
            self.dateFrom = e.target.closest('.vacation').getAttribute('data-date-from');
            self.dateTo = e.target.closest('.vacation').getAttribute('data-date-to');
            self.modal.show();
            break;
        }
      });
    }
    this.confirmEl = document.getElementById('vacation-modal-drop');
    if (this.confirmEl) {
      this.confirm = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal('#vacation-modal-drop', {
        keyboard: false
      });
      this.confirmEl.querySelector('button[action="drop"]').addEventListener('click', function (e) {
        return self.drop();
      });
    }
  }
  _createClass(_class, [{
    key: "initDate",
    value: function initDate() {
      var from = this.modalEl.querySelector('input[name="date_from"]'),
        to = this.modalEl.querySelector('input[name="date_to"]'),
        row = this.modalEl.querySelector('input[name="id"]'),
        pad = function pad(number) {
          if (number < 10) {
            return '0' + number;
          }
          return number;
        };
      from.min = new Date().getUTCFullYear() + '-01-01';
      if (!this.rowId) {
        var date = new Date(),
          dateStr = date.getUTCFullYear() + '-' + pad(date.getUTCMonth() + 1) + '-' + pad(date.getUTCDate());
        from.max = dateStr;
        from.value = dateStr;
        to.min = dateStr;
        to.max = '';
        to.value = dateStr;
        row.value = '0';
        return;
      }
      from.value = this.dateFrom;
      from.max = this.dateTo;
      to.value = this.dateTo;
      to.min = this.dateFrom;
      row.value = this.rowId;
    }
  }, {
    key: "check",
    value: function check() {
      var from = this.modalEl.querySelector('input[name="date_from"]').value,
        to = this.modalEl.querySelector('input[name="date_to"]').value;
      if (!from || !to) {
        return false;
      }
      from = from.replace(/\D/g, '') + 0;
      to = to.replace(/\D/g, '') + 0;
      return from <= to;
    }
  }, {
    key: "approve",
    value: function approve() {
      var form = document.getElementById('vacation-approve');
      form.querySelector('input[name="id"]').value = this.rowId;
      form.querySelector('input[name="approve"]').value = 1;
      form.submit();
    }
  }, {
    key: "unapproved",
    value: function unapproved() {
      var form = document.getElementById('vacation-approve');
      form.querySelector('input[name="id"]').value = this.rowId;
      form.querySelector('input[name="approve"]').value = 0;
      form.submit();
    }
  }, {
    key: "drop",
    value: function drop() {
      var form = document.getElementById('vacation-drop');
      form.querySelector('input[name="id"]').value = this.rowId;
      form.submit();
    }
  }]);
  return _class;
}();

/***/ })

}]);