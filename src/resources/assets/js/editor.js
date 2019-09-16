let Editor = (() => {
  const Delta = Quill.import('delta')
  const AUTOSAVE_REFRESH = 2000

  class Editor {
    /*
              Properties
          */
    // ui = { title: null, editorContent: null }
    // placeholder;
    // content;
    // quill;
    // change;
    // needSave

    constructor () {
      this.ui = {
        title: document.querySelector('[data-post=title]'),
        editorContent: document.querySelector('#editorContent')
      }
      this.placeholder = this.ui.editorContent.dataset.quillPlaceholder
      this.content = LBConfig.quillContent
      this.needSave = false
    }

    init () {
      this.initQuill()
      this.initEvents()
      this.initTimer()
      // update counter at page load
      statusBar.updateCounter(this.countWords(this.ui.editorContent.innerText))
    }

    initQuill () {
      this.change = new Delta()

      let defaultConfig = {
        placeholder: this.placeholder,
        theme: 'snow',
        modules: {
          toolbar: {
            container: '#topbar',
            handlers: {
              'image': this.quillImageHandler.bind(this)
            }
          }
        }
      }

      this.quill = new Quill(this.ui.editorContent, defaultConfig)

      if (this.content) {
        this.quill.setContents(this.content)
      }
    }

    initEvents () {
      this.quill.on('text-change', (delta, oldDelta, source) => {
        this.change = this.change.compose(delta)
        statusBar.updateCounter(this.countWords(this.ui.editorContent.innerText))
      })

      this.ui.title.addEventListener('keydown', () => {
        this.needSave = true
      })
    }

    initTimer () {
      setInterval(() => {
        // if there are changes
        if (this.change.length() > 0 || this.needSave) {
          this.change = new Delta()

          // saving state
          statusBar.stateSaving()

          this.sendData(this.getFormData()).then(
            // Success
            (response) => {
              this.needSave = false
              // update save status
              statusBar.lastSave = Date.now()
              statusBar.updateTimeAgo()
              statusBar.stateNormal()

              translation.updateStateTags(response.post.langs)
            },
            // Error
            (error) => {
              statusBar.stateError()
              console.error('save ko !')
            }
          )
        }
      }, AUTOSAVE_REFRESH)
    }

    getFormData () {
      let formData = new FormData()

      formData.append('title', this.ui.title.value)
      formData.append('content', this.quill.root.innerHTML)
      formData.append('quill_content', JSON.stringify(this.quill.getContents()))

      return formData
    }

    sendData (data) {
      return new Promise((resolve, reject) => {
        let request = new XMLHttpRequest()
        request.open('POST', LBConfig.updateUrl, true)
        request.setRequestHeader('Accept', 'application/json')
        request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
        request.onload = function (event) {
          if (request.status == 200) {
            const data = JSON.parse(request.response)
            resolve(data)
          } else {
            const data = JSON.parse(request.response)
            reject(data)
          }
        }

        request.send(data)
      })
    }

    sendImage (data) {
      return new Promise((resolve, reject) => {
        let request = new XMLHttpRequest()
        request.open('POST', LBConfig.uploadImageUrl, true)

        request.setRequestHeader('Accept', 'application/json')
        request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

        request.upload.addEventListener('progress', function (e) {
          var progress = Math.round((e.loaded * 100.0) / e.total)
          // console.log("Progress = " + progress);
        })

        request.onload = function (event) {
          if (request.status == 200) {
            var data = JSON.parse(request.response)
            resolve(data.url)
            } else {
            const data = JSON.parse(request.response)
            reject(data)
          }
        }

        request.send(data)
      })
    }

    /**
           * Handlers
           */

    quillImageHandler () {
      // this.quill.enable(false);
      let fileInput = this.quill.container.querySelector('input.ql-image[type=file]')
      if (fileInput == null) {
        fileInput = document.createElement('input')
        fileInput.setAttribute('type', 'file')
        fileInput.setAttribute('accept', 'image/png, image/gif, image/jpeg, image/bmp, image/x-icon')
        fileInput.classList.add('ql-image')
        fileInput.style.display = 'none'
        fileInput.addEventListener('change', () => {
          if (fileInput.files != null && fileInput.files[0] != null) {
            var formData = new FormData()
            formData.append('file', fileInput.files[0])
            this.sendImage(formData).then(
              // Success
              (data) => {
                // this.quill.enable(true);
                let range = this.quill.getSelection(true)
                this.quill.updateContents(new Delta()
                  .retain(range.index)
                  .delete(range.length)
                  .insert({
                    image: data
                  }), Quill.sources.USER)
                fileInput.value = ''
                fileInput.remove()
              },
              // Error
              (error) => {
                // this.quill.enable(true);
                alert(error)
              }
            )
          }
        })
        this.quill.container.appendChild(fileInput)
      }
      fileInput.click()
    }

    /**
           * Helpers
           */

    countWords (text) {
      let counter = 0
      if (text.length !== 1) {
        counter = text.replace(/\s\s+/g, ' ').split(' ').length
      }
      return counter
    }
  }

  return Editor
})()