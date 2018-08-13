let Meta = (() => {

    let model = [
        'hyperlink',
        'excerpt',
        'isFeatured',
        'isIndexed',
        'seoTitle',
        'seoDescription',
        'twitterTitle',
        'twitterDescription',
        'facebookTitle',
        'facebookDescription',
    ];

    class Meta {
        constructor() {
            this.fields = {};
        }

        init() {
            this.queryElements();
            this.bindEvents();
        }

        queryElements() {
            model.forEach(elem => {
                this.fields[elem] = document.getElementById(elem);
            });
        }

        bindEvents() {
            for (var prop in this.fields) {
                this.fields[prop].addEventListener('change', (e) => {
                    this.data();
                });
            }
        }

        data() {
            let data = {};

            for (var prop in this.fields) {
                if(this.fields[prop].type === 'checkbox') {
                    data[prop] = this.fields[prop].checked;
                } else {
                    data[prop] = this.fields[prop].value;
                }
            };

            // @brybry: get post metadata from here :)
            statusBar.stateSaving();

            this.sendData(data).then(
                // Success
                (response) => {
                    statusBar.lastSave = Date.now();
                    statusBar.updateTimeAgo();
                    statusBar.stateNormal();
                },
                // Error
                (error) => {
                    statusBar.stateError();
                }
            )



            return data;
        }

        sendData(data) {
            return new Promise((resolve, reject) => {
                let request = new XMLHttpRequest();
                request.open("POST", LBConfig.updateMetaUrl, true);
                request.setRequestHeader('Accept', 'application/json');
                request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                request.onload = function (event) {
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

    }

    return Meta;
})();
