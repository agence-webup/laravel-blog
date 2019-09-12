let Meta = (() => {
  let model = [
    'hyperlink',
    'excerpt',
    // 'isFeatured',
    'seoTitle',
    'seoDescription',
    'twitterTitle',
    'twitterDescription',
    'facebookTitle',
    'facebookDescription',
    'thumbnail'
  ]

  class Meta {
    constructor () {
      this.fields = {}
    }

    init () {
      this.queryElements()
      this.initThumbnailUploader()
      this.initEvents()
    }

    queryElements () {
      model.forEach(elem => {
        this.fields[elem] = document.getElementById(elem)
      })
    }

    initThumbnailUploader () {
      let fileInput = document.querySelector('#thumbnail_input')

      FilePond.registerPlugin(
        FilePondPluginImageTransform,
        FilePondPluginImageResize,
        FilePondPluginImagePreview
      )

      let fileData = []

      if (fileInput.dataset.pic) {
        fileData = [{
          source: fileInput.dataset.pic,
          options: {
            type: 'local'
          }
        }]
      }
      FilePond.create(
        fileInput,
        {
          labelIdle: `<span class="filepond--label-action">Uploader une image</span>`,
          // imagePreviewHeight: 170,
          imageCropAspectRatio: '16:9',
          imageResizeTargetWidth: 860,
          imageResizeTargetHeight: 400,
          files: fileData,
          server: {
            process: {
              url: fileInput.dataset.post,
              method: 'POST',
              onload: (response) => {
                var pictureInput = document.querySelector('[name=thumbnail]')
                pictureInput.value = response.path

                // Trigger on change for input
                if ('createEvent' in document) {
                  var evt = document.createEvent('HTMLEvents')
                  evt.initEvent('change', false, true)
                  pictureInput.dispatchEvent(evt)
                } else { pictureInput.fireEvent('onchange') }
              }
            },
            load: fileInput.dataset.pic + '?'
          }
        }
      )
    }

    initEvents () {
      for (var prop in this.fields) {
        if (this.fields[prop]) {
          this.fields[prop].addEventListener('change', (e) => {
            statusBar.stateSaving()
            this.sendData(this.getFormData()).then(
              // Success
              (response) => {
                this.fields['hyperlink'].value = response.post.hyperlink
                statusBar.lastSave = Date.now()
                statusBar.updateTimeAgo()
                statusBar.stateNormal()
                translation.updateStateTags(response.post.langs)
              },
              // Error
              (error) => {
                statusBar.stateError()
              }
            )
          })
        }
      }
    }

    getFormData () {
      let formData = new FormData()

      for (var prop in this.fields) {
        if (this.fields[prop].type && this.fields[prop].type === 'checkbox') {
          formData.append(this.fields[prop].name, (this.fields[prop].checked) ? 1 : 0)
        } else {
          formData.append(this.fields[prop].name, this.fields[prop].value)
        }
      };

      return formData
    }

    sendData (data) {
      return new Promise((resolve, reject) => {
        let request = new XMLHttpRequest()
        request.open('POST', LBConfig.updateMetaUrl, true)
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
  }

  return Meta
})()
