import puppeteer, { Page } from "puppeteer";
import fs from "fs";
import { dirname } from "path";
import { fileURLToPath } from "url";

(async () => {
	const browser = await puppeteer.launch({
		headless: "new",
    args: [
      '--no-sandbox',
      '--ignore-certificate-errors'
    ]
	});
	const page = await browser.newPage();

	const __filename = fileURLToPath(import.meta.url);
	const __dirname = dirname(__filename);

	const fileToGenerate = process.argv[2];
  const fileType = process.argv[3] ?? 'pdf'
  const hostname = process.argv[4] ?? 'localhost'

	let url = `http://${hostname}:8000/`;
	let fileName = "resume-default.pdf";
	let fileFolder = `${__dirname}/../data/files/`;

	if (!fs.existsSync(fileToGenerate)) {
		url += `${fileToGenerate}.html`;
		fileName = `${fileToGenerate}.${fileType}`;
	}

	const filePath = fileFolder + fileName;

	await getPage(page, __dirname, url);

	if (!fs.existsSync(fileFolder)) {
		fs.mkdirSync(fileFolder, { recursive: true });
	}
	
	await generateFile(page, filePath, fileType);

	await browser.close();

	console.log(
		`%s Your file is located at "${filePath}" ;) %s`,
		"\x1b[33m",
		"\x1b[0m"
	);

})();

async function generateFile(page, path, type) {

	if (type === 'pdf')
		return await page.pdf({
			format: "A4",
			// preferCSSPageSize: true,
			path: path,
			printBackground: true,
			margin: {
				top: "1cm",
				right: "1cm",
				bottom: "1cm",
				left: "1cm"
			},
		});

		// 1200x600
	return await page.screenshot({
		path: path,
		fullPage: true,
	});
}

function getPage(page, __dirname, url) {
	if (process.argv[2] && process.argv[2] === "--file=true") {
		const html = fs.readFileSync(`${__dirname}/../dist/index.html`, "utf8");
		return page.setContent(html, {
			waitUntil: "domcontentloaded",
		});
	}

	return page.goto(url, {waitUntil: 'networkidle0'});
	
}
