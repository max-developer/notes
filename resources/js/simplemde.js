import "simplemde/dist/simplemde.min.css"

let SimpleMDE = require('simplemde');

window.addEventListener('load', () => {
    let simple = new SimpleMDE({element: document.querySelector(".simple-mde")});
    simple.render()
})
