/**
 * Loops through each drawer element to apply showModal and close to their open and close buttons.
 * HTML EXAMPLE :
 *  <button class="zetia-drawer-open" data-target="example">open</button>
 *  <dialog id="example">
 *      <p>Lorem ipsum dolor sit amet etc.</p>
 *      <button class="zetia-drawer-close">close</button>
 *  </dialog>
 */

function closeDialog(dialogElement: HTMLDialogElement) {
    dialogElement.close()
}

function showDialog(dialogElement: HTMLDialogElement) {
    dialogElement.showModal()
}

(() => {
    const dialogNodes: NodeListOf<HTMLDialogElement> = document.querySelectorAll(".zetia-drawer")

    for (const dialogNode of dialogNodes) {
        // If the user clicks outside the dialogbox when it's open, it closes it.
        dialogNode.addEventListener("click", (e) => {
            const target = e.target as Element
            const rect = target?.getBoundingClientRect()
            if (!rect) return

            const isClickInsideDialog = (
                rect.top <= e.clientY &&
                e.clientY <= rect.top + rect.height &&
                rect.left <= e.clientX &&
                e.clientX <= rect.left + rect.width
            )
            if (!isClickInsideDialog) closeDialog(dialogNode)
        })

        const id = dialogNode.id
        const openButton = document.querySelector(`.zetia-drawer-open[data-target='${id}']`)
        console.log(openButton, id, dialogNode)
        if (openButton) openButton.addEventListener('click', () => showDialog(dialogNode))

        const closeButton = dialogNode.querySelector('.zetia-drawer-close')
        if (closeButton) closeButton.addEventListener('click', () => closeDialog(dialogNode))
    }
})()
