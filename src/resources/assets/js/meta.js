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
            console.log(data);
            return data;
        }
    }

    return Meta;
})();
