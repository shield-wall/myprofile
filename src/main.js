import Markdoc, { Tag } from "@markdoc/markdoc";

const config = {
    tags: {
        column: {
            render: 'div class="myprofile-column"',
        },
        block: {
            transform(node, config) {
                const newConfig = node.transformAttributes(config);

                if (newConfig.class)
                    newConfig.class += ' myprofile-block';
                
                if (!newConfig.class)  
                    newConfig.class = ' myprofile-block'; 

                return new Tag(
                    `div`,
                    newConfig,
                    node.transformChildren(config)
                  );
            }
        },
        timeline: {
            render: 'div class="myprofile-timeline"'
        },
        content: {
            render: 'div class="myprofile-content"'
        },
        text: {
            transform(node, config) {
                const newConfig = node.transformAttributes(config);
                newConfig.class += ' content';

                return new Tag(
                    `div`,
                    newConfig,
                    node.transformChildren(config)
                  );
            }
        }
    }
};


const source = await fetch('data.md').then(r => r.text());
const parse = Markdoc.parse(source);
const transform = Markdoc.transform(parse, config);
const html = Markdoc.renderers.html(transform);

document.querySelector("#app").innerHTML = html;
