/**
 * Removes all whitespaces from elements in the DOM with the class "no-whitespace"
 */
(() => {
    const affectedNodes = document.querySelectorAll(".no-whitespace")

    for (const node of affectedNodes) {
        let html = node.innerHTML
        // remove newline / carriage return
        html = html.replace(/\n/g, "")

        // remove whitespace (space and tabs) before tags
        html = html.replace(/[\t ]+\</g, "<")

        // remove whitespace between tags
        html = html.replace(/\>[\t ]+\</g, "><")

        // remove whitespace after tags
        html = html.replace(/\>[\t ]+$/g, ">")

        node.innerHTML = html
    }
})()