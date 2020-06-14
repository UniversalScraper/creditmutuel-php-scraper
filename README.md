# Crédit Mutuel Scraper

[![Latest Stable Version](https://poser.pugx.org/scraperize/creditmutuel-scraper/v/stable)](https://packagist.org/packages/scraperize/creditmutuel-scraper)
[![Total Downloads](https://poser.pugx.org/scraperize/creditmutuel-scraper/downloads)](https://packagist.org/packages/scraperize/creditmutuel-scraper)
[![Build Status](https://travis-ci.org/scraperize/creditmutuel-scraper.png?branch=master)](https://travis-ci.org/scraperize/creditmutuel-scraper)
[![Dependency Status](https://www.versioneye.com/user/projects/58621fd94296de004b499bec/badge.svg?style=flat)](https://www.versioneye.com/user/projects/58621fd94296de004b499bec)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e8ea2a10-d876-454e-a3ae-0e6af2f2926d/mini.png)](https://insight.sensiolabs.com/projects/e8ea2a10-d876-454e-a3ae-0e6af2f2926d)

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
