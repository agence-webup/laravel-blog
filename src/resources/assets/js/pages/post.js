// init meta sidebar
var metaSidebar = new Sidebar(
    document.querySelector('[data-sidebar="meta"]'), 
    document.querySelector('[data-sidebar="triggerMeta"]')
).init();

// init i18n sidebar
var i18nSidebar = new Sidebar(
    document.querySelector('[data-sidebar="i18n"]'), 
    document.querySelector('[data-sidebar="triggerI18n"]') 
).init();

// init status sidebar
var statusSidebar = new Sidebar(
    document.querySelector('[data-sidebar="status"]'), 
    document.querySelector('[data-sidebar="triggerStatus"]') 
).init();

// handle meta pannel
var meta = new Meta().init();

// handle status bar
var statusBar = new StatusBar().init();

// handle editor (Quill)
var editor = new Editor().init();