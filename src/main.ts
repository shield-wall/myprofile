import Markdoc from "@markdoc/markdoc";
import "./style/main.scss";

const tags = {
    column: {
        render: 'div class="myprofile-column"',
        attributes: {}
    },
    div: {
        render: 'div',
        attributes: {}
    }
};

const source = await fetch('./../data/data.md').then(r => r.text());
const ast = Markdoc.parse(source);
const transform = Markdoc.transform(ast, {tags});
const html = Markdoc.renderers.html(transform);

document.querySelector<HTMLDivElement>("#app")!.innerHTML = html;
