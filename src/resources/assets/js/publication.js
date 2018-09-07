let Publication = (() => {

    let model = [
        'isPublished',
        'published_at',
    ];

    class Publication {
        constructor() {
            this.fields = {};
        }

        init() {
            this.queryElements();
            this.initEvents();
        }

        queryElements() {
            let datePicker = document.getElementById("published_at")
            flatpickr(datePicker,{
                altInput: true,
                altFormat: "d/m/Y à H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            })
            model.forEach(elem => {
                this.fields[elem] = document.getElementById(elem);
            });            
        }

        initEvents() {
            for (var prop in this.fields) {
                this.fields[prop].addEventListener('change', (e) => {
                    statusBar.stateSaving();
                    this.sendData(this.getFormData()).then(
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
                    );
                });
            }
        }

        getFormData() {
            let formData = new FormData();
            
            for (var prop in this.fields) {
                
                if(this.fields[prop].type === 'checkbox') {
                    formData.append(this.fields[prop].name, (this.fields[prop].checked) ? 1 : 0 );
                } else {
                    formData.append(this.fields[prop].name, this.fields[prop].value);
                }
            };

            return formData;
        }

        sendData(data) {
            
            return new Promise((resolve, reject) => {
                let request = new XMLHttpRequest();
                request.open("POST", LBConfig.updatePublicationUrl, true);
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

    return Publication;
})();
