let Sidebar = (() => {

    let numberOfSidebarsOpened = 0;

    const CSS = {
        EDITOR_SIDEBAR_OPEN: 'editor-sidebar--open',
        EDITOR_SIDEBAR_CLOSING_MODE: 'editor-sidebarBtn--closingMode'
    };

    class Sidebar {

        constructor(target, triggers) {
            this.target = target;
            this.triggers = triggers;
        }

        init() {
            this._bindEvents();
            return this;
        }

        onTransitionEnd(callback) {
            let handler = e => {
                this.target.removeEventListener('transitionend', handler, false);
            };
            this.target.addEventListener('transitionend', handler);
        }

        _bindEvents() {
            this.triggers.addEventListener('click', () => {
                if (this.isOpen()) {
                    this.close();
                } else {
                    this.open();
                }
            });
        }

        isOpen() {
            return this.target.classList.contains(CSS.EDITOR_SIDEBAR_OPEN);
        }

        close() {
            numberOfSidebarsOpened--;
            this.target.classList.remove(CSS.EDITOR_SIDEBAR_OPEN);
            this.triggers.classList.remove(CSS.EDITOR_SIDEBAR_CLOSING_MODE);
            this.onTransitionEnd(()=> {
                this.target.style['z-index'] = null;
            });
        }

        open() {
            numberOfSidebarsOpened++;
            this.target.classList.add(CSS.EDITOR_SIDEBAR_OPEN);
            this.triggers.classList.add(CSS.EDITOR_SIDEBAR_CLOSING_MODE);
            this.target.style['z-index'] = 10 + numberOfSidebarsOpened;
        }
    }

    return Sidebar;
})();
