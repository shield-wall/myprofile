import puppeteer, { Page } from "puppeteer";
import fs from "fs";
import { dirname } from "path";
import { fileURLToPath } from "url";

(async () => {
	const browser = await puppeteer.launch({
		headless: true,
	});
	const page = await browser.newPage();

	const __filename = fileURLToPath(import.meta.url);
	const __dirname = dirname(__filename);

	await getPage(page, __dirname);

	let pdfFolder = `${__dirname}/../data/pdf`;
	if (!fs.existsSync(pdfFolder)) {
		fs.mkdirSync(pdfFolder, { recursive: true });
	}

	let pdf = await page.pdf({
		format: "A4",
		// preferCSSPageSize: true,
		path: `${pdfFolder}/resume.pdf`,
		printBackground: true,
		margin: {
			top: "1cm",
			right: "1cm",
			bottom: "1cm",
			left: "1cm"
		},
	});

	await browser.close();

	console.log(
		`%s Your pdf was generated in "data/pdf/" folder ;) %s`,
		"\x1b[33m",
		"\x1b[0m"
	);
	return pdf;
})();

function getPage(page: Page, __dirname: string) {
	if (process.argv[2] && process.argv[2] === "--file=true") {
		const html = fs.readFileSync(`${__dirname}/../dist/index.html`, "utf8");
		return page.setContent(html, {
			waitUntil: "domcontentloaded",
		});
	}

	return page.goto("http://localhost:8000/", {waitUntil: 'networkidle0'});
	
}
