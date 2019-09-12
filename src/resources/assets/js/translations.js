let Translation = (() => {
    const STATE = {
      PUBLISHED: document.querySelector('[data-template-translation-status=published]').innerHTML,
      DRAW: document.querySelector('[data-template-translation-status=draw]').innerHTML,
      UNKNOWN: document.querySelector('[data-template-translation-status=unknown]').innerHTML
    }
  
    class Translation {
      constructor () {
        this.translationsTags = document.querySelectorAll('[data-translation]')
      }
  
      updateStateTags (langs) {
        this.translationsTags.forEach(element => {
          if (langs[element.dataset.translation].isPublished) {
            element.innerHTML = STATE.PUBLISHED
          } else if (langs[element.dataset.translation].isDraw) {
            element.innerHTML = STATE.DRAW
          } else {
            element.innerHTML = STATE.UNKNOWN
          }
        })
      }
    }
  
    return Translation
  })()
  