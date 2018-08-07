let Editor = (() => {
    const Delta = Quill.import('delta');
    const AUTOSAVE_REFRESH = 5000;
    const TIMEAGO_REFRESH = 2000;

    class Editor {

        constructor(config){
          this.quillConfig = config.quillConfig;
          this.updateUrl = config.updateUrl;
          this.uploadImageUrl = config.uploadImageUrl;
          this.customHeaders = config.customHeaders;
          this.interfaceLang = config.interfaceLang;
          this.content = config.content;
        }

        init() {
            this.ui = {
                title: document.querySelector('[data-post=title]'),
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
            let defaultConfig = {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: '#topbar',
                        handlers: {
                          'image': this.quillImageHandler.bind(this)
                        }
                    },
                }
            }
            //Init Quill with defaultConfig merged with customConfig
            this.quill = new Quill(this.ui.editorContent, Object.assign({}, defaultConfig,this.quillConfig));

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
                      // Success
                      (response) => {
                        console.log("save ok !");
                        // update save status
                        this.lastSave = Date.now();
                        this.updateTimeAgo();
                      },
                      // Error
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

          formData.append("title",this.ui.title.value);
          formData.append("content",this.quill.root.innerHTML);
          formData.append("quill_content",JSON.stringify(this.quill.getContents()));

          return formData;
        }

        sendData(data) {
          return new Promise((resolve, reject) => {
              let request = new XMLHttpRequest();
              request.open("POST", this.updateUrl, true);
              request.setRequestHeader('Accept', 'application/json');

              for (let header in this.customHeaders) {
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

        sendImage(data){
          return new Promise((resolve, reject) => {
              let request = new XMLHttpRequest();
              request.open("POST", this.uploadImageUrl, true);

              request.setRequestHeader('Accept', 'application/json');

              for (let header in this.customHeaders) {
                if (this.customHeaders.hasOwnProperty(header)) {
                  request.setRequestHeader(header, this.customHeaders[header]);
                }
              }

              request.upload.addEventListener("progress", function(e) {
                var progress = Math.round((e.loaded * 100.0) / e.total);
                console.log("Progress = "+progress);
              });

              request.onload = function(event) {
                  if (request.status == 200) {
                      const data = JSON.parse(request.response);
                      resolve(data.url);
                  } else {
                      const data = JSON.parse(request.response);
                      reject(data);
                  }
              };

              request.send(data);
          });
        }


        /**
        * Handlers
        */

        quillImageHandler(){
          //this.quill.enable(false);
          let fileInput = this.quill.container.querySelector('input.ql-image[type=file]');
          if (fileInput == null) {
            fileInput = document.createElement('input');
            fileInput.setAttribute('type', 'file');
            fileInput.setAttribute('accept', 'image/png, image/gif, image/jpeg, image/bmp, image/x-icon');
            fileInput.classList.add('ql-image');
            fileInput.style.display = "none";
            fileInput.addEventListener('change', () => {
              if (fileInput.files != null && fileInput.files[0] != null) {
                var formData = new FormData();
                formData.append("file", fileInput.files[0]);
                this.sendImage(formData).then(
                  // Success
                  (data) => {
                    //this.quill.enable(true);
                    let range = this.quill.getSelection(true);
                    this.quill.updateContents(new Delta()
                      .retain(range.index)
                      .delete(range.length)
                      .insert({ image: data })
                    , Quill.sources.USER);
                    fileInput.value = "";
                    fileInput.remove();
                  },
                  // Error
                  (error) => {
                    //this.quill.enable(true);
                    alert(error);
                  }
                );
              }
            });
            this.quill.container.appendChild(fileInput);
          }
          fileInput.click();
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
