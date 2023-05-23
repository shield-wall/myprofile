import Markdoc, { Config, Node, Tag } from "@markdoc/markdoc";
import "./style/main.scss";

const config = {
    nodes: {
        softbreak: {
          transform() {
            return ' ';
          }
        },
      },
    tags: {
        column: {
            render: 'div class="myprofile-column"',
        },
        block: {
            transform(node: Node, config: Config) {
                const newConfig = node.transformAttributes(config);
                newConfig.class += ' myprofile-block';

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
        }
    }
};

const source = await fetch('./../data/data.md').then(r => r.text());
const parse = Markdoc.parse(source);
const transform = Markdoc.transform(parse, config);
const html = Markdoc.renderers.html(transform);

document.querySelector<HTMLDivElement>("#app")!.innerHTML = html;
