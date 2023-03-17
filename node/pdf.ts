import puppeteer from 'puppeteer';

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto('http://localhost:3000/');

    // Set screen size
    await page.setViewport({width: 1080, height: 1024});

    await page.pdf({
        format: 'A4',
        path: `my-fance-invoice.pdf`,
        preferCSSPageSize: true,
    })

    await browser.close();
})();