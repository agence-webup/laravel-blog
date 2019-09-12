"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}function _createClass(e,t,n){return t&&_defineProperties(e.prototype,t),n&&_defineProperties(e,n),e}var Editor=function(){var a=Quill.import("delta");return function(){function e(){_classCallCheck(this,e),this.ui={title:document.querySelector("[data-post=title]"),editorContent:document.querySelector("#editorContent")},this.placeholder=this.ui.editorContent.dataset.quillPlaceholder,this.content=LBConfig.quillContent,this.needSave=!1}return _createClass(e,[{key:"init",value:function(){this.initQuill(),this.initEvents(),this.initTimer(),statusBar.updateCounter(this.countWords(this.ui.editorContent.innerText))}},{key:"initQuill",value:function(){this.change=new a;var e={placeholder:this.placeholder,theme:"snow",modules:{toolbar:{container:"#topbar",handlers:{image:this.quillImageHandler.bind(this)}}}};this.quill=new Quill(this.ui.editorContent,e),this.content&&this.quill.setContents(this.content)}},{key:"initEvents",value:function(){var i=this;this.quill.on("text-change",function(e,t,n){i.change=i.change.compose(e),statusBar.updateCounter(i.countWords(i.ui.editorContent.innerText))}),this.ui.title.addEventListener("keydown",function(){i.needSave=!0})}},{key:"initTimer",value:function(){var t=this;setInterval(function(){(0<t.change.length()||t.needSave)&&(t.change=new a,statusBar.stateSaving(),t.sendData(t.getFormData()).then(function(e){t.needSave=!1,statusBar.lastSave=Date.now(),statusBar.updateTimeAgo(),statusBar.stateNormal(),translation.updateStateTags(e.post.langs)},function(e){statusBar.stateError(),console.error("save ko !")}))},2e3)}},{key:"getFormData",value:function(){var e=new FormData;return e.append("title",this.ui.title.value),e.append("content",this.quill.root.innerHTML),e.append("quill_content",JSON.stringify(this.quill.getContents())),e}},{key:"sendData",value:function(e){return new Promise(function(i,a){var o=new XMLHttpRequest;o.open("POST",LBConfig.updateUrl,!0),o.setRequestHeader("Accept","application/json"),o.setRequestHeader("X-CSRF-TOKEN",document.querySelector('meta[name="csrf-token"]').getAttribute("content")),o.onload=function(e){if(200==o.status){var t=JSON.parse(o.response);i(t)}else{var n=JSON.parse(o.response);a(n)}},o.send(e)})}},{key:"sendImage",value:function(e){return new Promise(function(n,i){var a=new XMLHttpRequest;a.open("POST",LBConfig.uploadImageUrl,!0),a.setRequestHeader("Accept","application/json"),a.setRequestHeader("X-CSRF-TOKEN",document.querySelector('meta[name="csrf-token"]').getAttribute("content")),a.upload.addEventListener("progress",function(e){Math.round(100*e.loaded/e.total)}),a.onload=function(e){if(200==a.status)n(a.response);else{var t=JSON.parse(a.response);i(t)}},a.send(e)})}},{key:"quillImageHandler",value:function(){var n=this,i=this.quill.container.querySelector("input.ql-image[type=file]");null==i&&((i=document.createElement("input")).setAttribute("type","file"),i.setAttribute("accept","image/png, image/gif, image/jpeg, image/bmp, image/x-icon"),i.classList.add("ql-image"),i.style.display="none",i.addEventListener("change",function(){if(null!=i.files&&null!=i.files[0]){var e=new FormData;e.append("file",i.files[0]),n.sendImage(e).then(function(e){var t=n.quill.getSelection(!0);n.quill.updateContents((new a).retain(t.index).delete(t.length).insert({image:e}),Quill.sources.USER),i.value="",i.remove()},function(e){alert(e)})}}),this.quill.container.appendChild(i)),i.click()}},{key:"countWords",value:function(e){var t=0;return 1!==e.length&&(t=e.replace(/\s\s+/g," ").split(" ").length),t}}]),e}()}();
"use strict";var confirmBtns=document.querySelectorAll("[data-confirm]");confirmBtns.forEach(function(r){r.addEventListener("click",function(n){var t=r.dataset.confirm||"Confirm ?";confirm(t)||n.preventDefault()})});
"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}function _createClass(e,t,n){return t&&_defineProperties(e.prototype,t),n&&_defineProperties(e,n),e}var Meta=function(){var n=["hyperlink","excerpt","isFeatured","seoTitle","seoDescription","twitterTitle","twitterDescription","facebookTitle","facebookDescription"];return function(){function e(){_classCallCheck(this,e),this.fields={}}return _createClass(e,[{key:"init",value:function(){this.queryElements(),this.initEvents()}},{key:"queryElements",value:function(){var t=this;n.forEach(function(e){t.fields[e]=document.getElementById(e)})}},{key:"initEvents",value:function(){var t=this;for(var e in this.fields)this.fields[e]&&this.fields[e].addEventListener("change",function(e){statusBar.stateSaving(),t.sendData(t.getFormData()).then(function(e){t.fields.hyperlink.value=e.post.hyperlink,statusBar.lastSave=Date.now(),statusBar.updateTimeAgo(),statusBar.stateNormal(),translation.updateStateTags(e.post.langs)},function(e){statusBar.stateError()})})}},{key:"getFormData",value:function(){var e=new FormData;for(var t in this.fields)"checkbox"===this.fields[t].type?e.append(this.fields[t].name,this.fields[t].checked?1:0):e.append(this.fields[t].name,this.fields[t].value);return e}},{key:"sendData",value:function(e){return new Promise(function(a,s){var i=new XMLHttpRequest;i.open("POST",LBConfig.updateMetaUrl,!0),i.setRequestHeader("Accept","application/json"),i.setRequestHeader("X-CSRF-TOKEN",document.querySelector('meta[name="csrf-token"]').getAttribute("content")),i.onload=function(e){if(200==i.status){var t=JSON.parse(i.response);a(t)}else{var n=JSON.parse(i.response);s(n)}},i.send(e)})}}]),e}()}();
"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}function _createClass(e,t,n){return t&&_defineProperties(e.prototype,t),n&&_defineProperties(e,n),e}var Publication=function(){var n=["isPublished","published_at"];return function(){function e(){_classCallCheck(this,e),this.fields={}}return _createClass(e,[{key:"init",value:function(){this.queryElements(),this.initEvents()}},{key:"queryElements",value:function(){var t=this,e=document.getElementById("published_at");flatpickr(e,{altInput:!0,altFormat:"d/m/Y à H:i",enableTime:!0,dateFormat:"Y-m-d H:i"}),n.forEach(function(e){t.fields[e]=document.getElementById(e)})}},{key:"initEvents",value:function(){var t=this;for(var e in this.fields)this.fields[e].addEventListener("change",function(e){statusBar.stateSaving(),t.sendData(t.getFormData()).then(function(e){statusBar.lastSave=Date.now(),statusBar.updateTimeAgo(),statusBar.stateNormal(),translation.updateStateTags(e.post.langs)},function(e){statusBar.stateError()})})}},{key:"getFormData",value:function(){var e=new FormData;for(var t in this.fields)"checkbox"===this.fields[t].type?e.append(this.fields[t].name,this.fields[t].checked?1:0):e.append(this.fields[t].name,this.fields[t].value);return e}},{key:"sendData",value:function(e){return new Promise(function(a,s){var i=new XMLHttpRequest;i.open("POST",LBConfig.updatePublicationUrl,!0),i.setRequestHeader("Accept","application/json"),i.setRequestHeader("X-CSRF-TOKEN",document.querySelector('meta[name="csrf-token"]').getAttribute("content")),i.onload=function(e){if(200==i.status){var t=JSON.parse(i.response);a(t)}else{var n=JSON.parse(i.response);s(n)}},i.send(e)})}}]),e}()}();
"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}function _createClass(e,t,n){return t&&_defineProperties(e.prototype,t),n&&_defineProperties(e,n),e}var Sidebar=function(){var t=0,i=[],s="editor-sidebar--open",r="editor-sidebarBtn--closingMode";return function(){function n(e,t){_classCallCheck(this,n),this.target=e,this.triggers=t}return _createClass(n,[{key:"init",value:function(){return this._bindEvents(),this}},{key:"onTransitionEnd",value:function(e){var n=this;this.target.addEventListener("transitionend",function e(t){n.target.removeEventListener("transitionend",e,!1)})}},{key:"_bindEvents",value:function(){var e=this;this.triggers.addEventListener("click",function(){e.isOpen()?e.close():e.open()})}},{key:"isOpen",value:function(){return this.target.classList.contains(s)}},{key:"close",value:function(){var e=this;t--,this._closeSidebar(this),this.onTransitionEnd(function(){e.target.style["z-index"]=null})}},{key:"open",value:function(){for(t++;0<i.length;){var e=i.shift();this._closeSidebar(e)}i.push(this),this.target.classList.add(s),this.triggers.classList.add(r),this.target.style["z-index"]=10+t}},{key:"_closeSidebar",value:function(e){e.target.classList.remove(s),e.triggers.classList.remove(r)}}]),n}()}();
"use strict";function _classCallCheck(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function _defineProperties(t,e){for(var a=0;a<e.length;a++){var s=e[a];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(t,s.key,s)}}function _createClass(t,e,a){return e&&_defineProperties(t.prototype,e),a&&_defineProperties(t,a),t}var StatusBar=function(){var e="loading-flicker",a="editor-status--normal",s="editor-status--saving",r="editor-status--error";return function(){function t(){_classCallCheck(this,t),this.ui={counter:document.querySelector("[data-counter]"),timeAgo:document.querySelector("[data-timeago]"),statusWrapper:document.querySelector('[data-status="wrapper"]'),statusIndicator:document.querySelector('[data-status="indicator"]'),statusNormal:document.querySelector('[data-status="normal"]'),statusSaving:document.querySelector('[data-status="saving"]'),statusError:document.querySelector('[data-status="error"]')},this.lastSave=null}return _createClass(t,[{key:"init",value:function(){return this.initTimeAgo(),this}},{key:"initTimeAgo",value:function(){var t=this;this.timeagoInstance=timeago(),setInterval(function(){t.updateTimeAgo()},1e3)}},{key:"stateError",value:function(t){this.resetState(),this.ui.statusWrapper.classList.add(r)}},{key:"stateSaving",value:function(){this.resetState(),this.ui.statusIndicator.classList.add(e),this.ui.statusWrapper.classList.add(s)}},{key:"stateNormal",value:function(){this.resetState(),this.ui.statusWrapper.classList.add(a)}},{key:"resetState",value:function(){this.ui.statusIndicator.classList.remove(e),this.ui.statusWrapper.classList.remove(a),this.ui.statusWrapper.classList.remove(s),this.ui.statusWrapper.classList.remove(r)}},{key:"updateTimeAgo",value:function(){this.ui.timeAgo.innerHTML=this.timeagoInstance.format(this.lastSave,LBConfig.uiLang)}},{key:"updateCounter",value:function(t){this.ui.counter.innerHTML=t}}]),t}()}();
"use strict";function _classCallCheck(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function _defineProperties(t,e){for(var n=0;n<e.length;n++){var a=e[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(t,a.key,a)}}function _createClass(t,e,n){return e&&_defineProperties(t.prototype,e),n&&_defineProperties(t,n),t}var Translation=function(){var n={PUBLISHED:document.querySelector("[data-template-translation-status=published]").innerHTML,DRAW:document.querySelector("[data-template-translation-status=draw]").innerHTML,UNKNOWN:document.querySelector("[data-template-translation-status=unknown]").innerHTML};return function(){function t(){_classCallCheck(this,t),this.translationsTags=document.querySelectorAll("[data-translation]")}return _createClass(t,[{key:"updateStateTags",value:function(e){this.translationsTags.forEach(function(t){e[t.dataset.translation].isPublished?t.innerHTML=n.PUBLISHED:e[t.dataset.translation].isDraw?t.innerHTML=n.DRAW:t.innerHTML=n.UNKNOWN})}}]),t}()}();