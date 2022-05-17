import hlJs from 'highlight.js';
import "highlight.js/styles/github.css";

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((el) => {
        hlJs.highlightElement(el);
    });
});

