# Crédit Mutuel Scraper

[![Latest Stable Version](https://poser.pugx.org/scraperize/creditmutuel-scraper/v)](//packagist.org/packages/scraperize/creditmutuel-scraper)
[![Latest Unstable Version](https://poser.pugx.org/scraperize/creditmutuel-scraper/v/unstable)](//packagist.org/packages/scraperize/creditmutuel-scraper)
[![Total Downloads](https://poser.pugx.org/scraperize/creditmutuel-scraper/downloads)](//packagist.org/packages/scraperize/creditmutuel-scraper)
[![License](https://poser.pugx.org/scraperize/creditmutuel-scraper/license)](//packagist.org/packages/scraperize/creditmutuel-scraper)
[![Build Status](https://travis-ci.org/scraperize/creditmutuel-scraper.png?branch=master)](//travis-ci.org/scraperize/creditmutuel-scraper)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ac6ef016-d3a3-41f5-af31-9834e2f8e806/mini.png)](//insight.sensiolabs.com/projects/ac6ef016-d3a3-41f5-af31-9834e2f8e806)
[![Known Vulnerabilities](https://snyk.io/test/github/scraperize/creditmutuel-scraper/badge.svg?targetFile=composer.lock)](https://snyk.io/test/github/scraperize/creditmutuel-scraper?targetFile=composer.lock)

## Installation

    composer require scraperize/creditmutuel-scraper

## Usage

### Download all accounts CSV

    // Your account username
    $username = 'xxxxxxxxxx';
    
    // Your account password
    $password = 'xxxxxxxxxx';

    (new CreditmutuelScraper())
        ->auth($username, $password)
        ->downloadCsv('MyPath/')
    ;

### Download only specifics accounts CSV

    (new CreditmutuelScraper())
        ->auth($username, $password)
        ->downloadCsv('MyPath/', [
            'xxxxxxxxxx',
            'xxxxxxxxxx',
        ])
    ;
