let StatusBar = (() => {
    const TIMEAGO_REFRESH = 1000;

    class StatusBar {

        constructor() {
            this.ui = {
                counter: document.querySelector('[data-counter]'),
                timeAgo: document.querySelector('[data-timeago]')
            };
            this.lastSave = null;

        }

        init() {
            this.initTimeAgo();
            return this;
        } 

        initTimeAgo() {
            // init timeago
            this.timeagoInstance = timeago();

            // launch refresh timer
            setInterval(() => {
                this.updateTimeAgo();
            }, TIMEAGO_REFRESH);
        }

        updateTimeAgo() {
            this.ui.timeAgo.innerHTML = this.timeagoInstance.format(this.lastSave, LBConfig.uiLang);
        }

        updateCounter(value) {
            this.ui.counter.innerHTML = value;
        }

    }

    return StatusBar;
})();
