import * as bootstrap from 'bootstrap';
window.VacationModal = class {
    constructor() {
        let self = this,
            vacationTable = document.querySelector('table.vacations');
        this.dateFrom = null;
        this.dateTo = null;
        this.rowId = null;
        this.btnNewVacation = document.getElementById('new-vacation-btn');
        if (this.btnNewVacation) {
            this.btnNewVacation.addEventListener('click', () => {
                self.dateFrom = null;
                self.dateTo = null;
                self.rowId = null;
            });
        }
        this.modalEl = document.getElementById('vacation-modal');
        if (this.modalEl) {
            this.modalEl.addEventListener('shown.bs.modal', () => {
                    self.initDate();
                });
            this.modalEl.querySelector('#form-vacation')
                .addEventListener('submit', function (e){
                    return self.check();
                });
            this.modal = new bootstrap.Modal('#vacation-modal', {
                keyboard: false
            });
            let from = this.modalEl.querySelector('input[name="date_from"]'),
                to = this.modalEl.querySelector('input[name="date_to"]');
            from.addEventListener('change', function(){
                to.min = this.value;
            });
            to.addEventListener('change', function(){
                from.max = this.value;
            });
        }
        if (vacationTable) {
            vacationTable.addEventListener('click', (e) => {
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
            this.confirm = new bootstrap.Modal('#vacation-modal-drop', {
                keyboard: false
            });
            this.confirmEl.querySelector('button[action="drop"]')
                .addEventListener('click', function (e){
                    return self.drop();
                })
        }

    }

    initDate(){
        let from = this.modalEl.querySelector('input[name="date_from"]'),
            to = this.modalEl.querySelector('input[name="date_to"]'),
            row = this.modalEl.querySelector('input[name="id"]'),
            pad = function (number) {
                if (number < 10) {
                    return '0' + number;
                }
                return number;
            };
        from.min = (new Date()).getUTCFullYear() + '-01-01';
        if (!this.rowId) {
            let date = new Date(),
                dateStr = date.getUTCFullYear() +
                    '-' + pad(date.getUTCMonth() + 1) +
                    '-' + pad(date.getUTCDate());

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

    check(){
        let from = this.modalEl.querySelector('input[name="date_from"]').value,
            to = this.modalEl.querySelector('input[name="date_to"]').value;
        if (!from || !to) {
            return false;
        }
        from = from.replace(/\D/g, '') + 0;
        to = to.replace(/\D/g, '') + 0;
        return from <= to;

    }

    approve(){
        let form = document.getElementById('vacation-approve');
        form.querySelector('input[name="id"]').value = this.rowId;
        form.querySelector('input[name="approve"]').value = 1;
        form.submit();
    }

    unapproved(){
        let form = document.getElementById('vacation-approve');
        form.querySelector('input[name="id"]').value = this.rowId;
        form.querySelector('input[name="approve"]').value = 0;
        form.submit();
    }
    drop(){
        let form = document.getElementById('vacation-drop');
        form.querySelector('input[name="id"]').value = this.rowId;
        form.submit();
    }
}
