let Sidebar = (() => {

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
            this.target.classList.remove(CSS.EDITOR_SIDEBAR_OPEN);
            this.triggers.classList.remove(CSS.EDITOR_SIDEBAR_CLOSING_MODE);
        }

        open() {
            this.target.classList.add(CSS.EDITOR_SIDEBAR_OPEN);
            this.triggers.classList.add(CSS.EDITOR_SIDEBAR_CLOSING_MODE);
        }
    }

    return Sidebar;
})();
