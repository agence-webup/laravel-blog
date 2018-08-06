let Editor = (() => {
    const Delta = Quill.import('delta');
    const AUTOSAVE_REFRESH = 1000;
    const TIMEAGO_REFRESH = 10000;

    class Editor {

        constructor(config){
          this.updateUrl = config.updateUrl;
          this.customHeaders = config.customHeaders;
          this.interfaceLang = config.interfaceLang;
          this.content = config.content;
        }

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

            if(this.content){
                this.quill.setContents(this.content);
            }
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

                    this.sendData(this.getFormData()).then(
                      //Success
                      (response) => {
                        console.log("save ok !");
                        // update save status
                        this.lastSave = Date.now();
                        this.updateTimeAgo();
                      },
                      //Error
                      (error) => {
                        console.error("save ko !");
                      }
                    )
                }
            }, AUTOSAVE_REFRESH);

            setInterval(() => {
               this.updateTimeAgo();
            }, TIMEAGO_REFRESH);
        }

        getFormData() {
          let formData = new FormData();

          formData.append("title",document.querySelector("[data-post='title']").value);
          formData.append("content",this.quill.root.innerHTML);
          formData.append("quill_content",JSON.stringify(this.quill.getContents()));

          return formData;
        }

        sendData(data) {
          return new Promise((resolve, reject) => {
              let request = new XMLHttpRequest();
              request.open("POST", this.updateUrl, true);

              request.setRequestHeader('Accept', 'application/json');

              for (var header in this.customHeaders) {
                if (this.customHeaders.hasOwnProperty(header)) {
                  request.setRequestHeader(header, this.customHeaders[header]);
                }
              }

              request.onload = function(event) {
                  if (request.status == 200) {
                      const data = JSON.parse(request.response);
                      resolve(data);
                  } else {
                      const data = JSON.parse(request.response);
                      reject(data);
                  }
              };

              request.send(data);
          });
        }

        /**
         * UI
         */

        updateTimeAgo() {
            this.ui.timeAgo.innerHTML = this.timeagoInstance.format(this.lastSave, this.interfaceLang);
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
