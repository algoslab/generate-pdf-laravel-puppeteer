
import puppeteer from 'puppeteer';


const htmlContent = process.argv[2] ?? '';


(async() => {
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();

     await page.setContent(htmlContent, {waitUntil: 'load'});
    //const screenshot = await page.screenshot();
    const pdf = await page.pdf();

    
    process.stdout.write(pdf);
    await browser.close();
})();