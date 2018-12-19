let StatusBar = (() => {
    const TIMEAGO_REFRESH = 1000;
    const CSS = {
        LOADER: 'loading-flicker',
        STATUS_NORMAL: 'editor-status--normal',
        STATUS_SAVING: 'editor-status--saving',
        STATUS_ERROR: 'editor-status--error'
    };

    // TODO: need a refactoring
    class StatusBar {

        constructor() {
            this.ui = {
                counter: document.querySelector('[data-counter]'),
                timeAgo: document.querySelector('[data-timeago]'),
                statusWrapper: document.querySelector('[data-status="wrapper"]'),
                statusIndicator: document.querySelector('[data-status="indicator"]'),
                statusNormal: document.querySelector('[data-status="normal"]'),
                statusSaving: document.querySelector('[data-status="saving"]'),
                statusError: document.querySelector('[data-status="error"]'),
            };
            // keep last save 
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

        stateError(error) {
            this.resetState();
            this.ui.statusWrapper.classList.add(CSS.STATUS_ERROR);
        }

        stateSaving() {
            this.resetState();
            this.ui.statusIndicator.classList.add(CSS.LOADER);
            this.ui.statusWrapper.classList.add(CSS.STATUS_SAVING);
        }

        stateNormal() {
            this.resetState();
            this.ui.statusWrapper.classList.add(CSS.STATUS_NORMAL);
        }

        resetState() {
            this.ui.statusIndicator.classList.remove(CSS.LOADER);
            this.ui.statusWrapper.classList.remove(CSS.STATUS_NORMAL);
            this.ui.statusWrapper.classList.remove(CSS.STATUS_SAVING);
            this.ui.statusWrapper.classList.remove(CSS.STATUS_ERROR);
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
