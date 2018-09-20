let Translation = (() => {

    const STATE = {
        PUBLISHED: document.querySelector("[data-template-translation-status=published]").innerHTML,
        DRAW: document.querySelector("[data-template-translation-status=draw]").innerHTML,
        UNKNOWN: document.querySelector("[data-template-translation-status=unknown]").innerHTML
    };

    class Translation {
        constructor() {
            this.translationsTags = document.querySelectorAll("[data-translation]");
        }

        updateStateTags(){
            console.log("louloulou");
            this.translationsTags.forEach(element => {
                element.innerHTML = STATE.PUBLISHED;
            });
        }

    }

    return Translation;
})();
