import fs from "fs";
import YAML from "yaml";

const file = fs.readFileSync('./data/data.yaml', 'utf8')
let json =  JSON.stringify(YAML.parse(file), null, 4);
createJsonFile(json)

function createJsonFile(json:string)
{
    if (!fs.existsSync('./data/json/')) {
        fs.mkdirSync('./data/json/', { recursive: true });
    }

    fs.writeFile('./data/json/data.json', json,function (err) {
        if (err) throw err;
        console.log(
            '%s Your yaml file was successfully converted to json into "data/json/" folder ;) %s',
            '\x1b[33m',
            '\x1b[0m',
        );
    });
}

