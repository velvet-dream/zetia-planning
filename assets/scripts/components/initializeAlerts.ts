function initializeAlerts() {
    const alerts: NodeListOf<HTMLElement> = document.querySelectorAll(".zetia-alert")
    for (const alert of alerts) {
        const closeButton = alert.querySelector(".zetia-alert-header .zetia-button")

        if (closeButton) {
            closeButton.addEventListener("click", () => { alert.remove() })
        } else console.error('No closing button defined on', alert)

        // timeout in s before alert must be removed
        const timeoutValue = parseFloat(alert.dataset['timeout'] ?? '0')

        if (timeoutValue <= 0) continue

        setTimeout(() => {
            // adding this class makes the alert go byebye
            alert.classList.add("zetia-alert-closing")
            setTimeout(() => {
                alert.remove()
            }, 1000)
        }, timeoutValue * 1000)
    }
}

initializeAlerts()