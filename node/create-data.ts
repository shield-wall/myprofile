import fs from 'fs';

const content = fs.readFileSync('./data/data.txt', 'utf8');

let match =  content.match(/```yaml([^<]+)```/i);
// @ts-ignore
let yaml = match[1];

fs.writeFile('./data/data.yaml', yaml,function (err) {
    if (err) throw err;
    console.log(
        '%s Data file was successfully created ;) %s',
        '\x1b[33m',
        '\x1b[0m',
    );
});