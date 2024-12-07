
import puppeteer from 'puppeteer';


const url = process.argv[2] ?? '';


(async() => {
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();

     await page.goto(url, {waitUntil: 'load'});
    //const screenshot = await page.screenshot();
    const pdf = await page.pdf();

    
    process.stdout.write(pdf);
    await browser.close();
})();