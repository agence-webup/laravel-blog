let Editor = (() => {
    const Delta = Quill.import('delta');
    const AUTOSAVE_REFRESH = 5000;
    const TIMEAGO_REFRESH = 10000;

    class Editor {
        init() {
            this.ui = {
                counter: document.querySelector('[data-counter]'),
                timeAgo: document.querySelector('[data-timeago]'),
                editorContent: document.querySelector('#editorContent')
            };

            this.initQuill();
            this.initTimeAgo();
            this.initEvents();
            this.initTimer();

            // update counter at page load
            this.updateCounter(this.countWords(this.ui.editorContent.innerText));
            this.lastSave = null;
        }

        initQuill() {
            this.change = new Delta;
            this.quill = new Quill('#editorContent', {
                theme: 'snow',
                placeholder: "Qu'allez-vous raconter aujourd'hui ?",
                modules: {
                    toolbar: {
                        container: '#topbar'
                    },
                }
            });
        }

        initTimeAgo() {
            this.timeagoInstance = timeago();
        }

        initEvents() {
            this.quill.on('text-change', (delta, oldDelta, source) => {
                this.change = this.change.compose(delta);
                this.updateCounter();
            });
        }

        initTimer() {
            setInterval(() => {
                // if there are changes
                if (this.change.length() > 0) {
                    this.change = new Delta();

                    // update save status
                    this.lastSave = Date.now();
                    this.updateTimeAgo();
                }
            }, AUTOSAVE_REFRESH);

            setInterval(() => {
               this.updateTimeAgo();
            }, TIMEAGO_REFRESH);
        }

        /**
         * UI
         */

        updateTimeAgo() {
            this.ui.timeAgo.innerHTML = this.timeagoInstance.format(this.lastSave, 'fr');
        }

        updateCounter(value = null) {
            let counter = counter ? value : this.countWords(this.quill.getText());
            this.ui.counter.innerHTML = counter;
        }

        /**
         * Helpers
         */

        countWords(text) {
            return text.replace(/\s\s+/g, ' ').split(' ').length - 1;
        }
    }

    return Editor;
})();
