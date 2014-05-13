<?php
// An example of using php-webdriver.

require_once('lib/__init__.php');

// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://docs.seleniumhq.org/'
$driver->get('http://fuzoku.jp/');

// adding cookie
$driver->manage()->deleteAllCookies();
$driver->manage()->addCookie(array(
  'name' => 'cookie_name',
  'value' => 'cookie_value',
));
$cookies = $driver->manage()->getCookies();
print_r($cookies);

// click the link 'About'
$link = $driver->findElement(
  // WebDriverBy::id('menu_about')
  WebDriverBy::xpath('html/body/table[2]/tbody/tr/td[2]/table[2]/tbody/tr/td[2]/h2/a')
);
$link->click();

// print the title of the current page
echo "The title is " . $driver->getTitle() . "'\n";
// print the title of the current page
echo "The current URI is " . $driver->getCurrentURL() . "'\n";

// Search 'php' in the search box
$link2 = $driver->findElement(
  WebDriverBy::xpath('html/body/table[2]/tbody/tr/td[2]/table[3]/tbody/tr/td[1]/table[1]/tbody/tr[3]/td/table[2]/tbody/tr[1]/td/h3/a')
);
$link2->click();
// print the title of the current page
echo "The title is " . $driver->getTitle() . "'\n";
// print the title of the current page
echo "The current URI is " . $driver->getCurrentURL() . "'\n";

$link3 = $driver->findElement(
  WebDriverBy::xpath(".//*[@id='area1']/tbody/tr[1]/td[2]/h4/a")
);
$link3->click();
// print the title of the current page
echo "The title is " . $driver->getTitle() . "'\n";
// print the title of the current page
echo "The current URI is " . $driver->getCurrentURL() . "'\n";

// $input->sendKeys('php')->submit();

// wait at most 10 seconds until at least one result is shown
$driver->wait(10)->until(
  WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
    WebDriverBy::className('gsc-result')
  )
);

// close the Firefox
$driver->quit();
