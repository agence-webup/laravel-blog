var confirmBtns = document.querySelectorAll("[data-confirm]");

confirmBtns.forEach(confirmBtn => {
    confirmBtn.addEventListener("click",(event) => {
        let message = confirmBtn.dataset.confirm || "Confirm ?";
        if(!confirm(message)){
            event.preventDefault();
        }
    })
});
