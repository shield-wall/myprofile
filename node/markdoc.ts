import Markdoc from '@markdoc/markdoc';
import fs from "fs";

const source = fs.readFileSync("./data/data.md", "utf8");
const ast = Markdoc.parse(source);
const content = Markdoc.transform(ast, /* config */);

const html = `
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Myprofile resume</title>
  <script type="module" src="/src/main.ts"></script>
  </head>
  <body>
  <div id="app">${Markdoc.renderers.html(content)}</div>
  </body>
</html>
`;

createIndex(html);

function createIndex(html: string) {
    if (!fs.existsSync("./public/")) {
        fs.mkdirSync("./public/", { recursive: true });
    }

    fs.writeFile("./public/index.html", html, function (err) {
        if (err) throw err;
        console.log(
            '%s Index file created inside public folder %s',
            "\x1b[33m",
            "\x1b[0m"
        );
    });
}