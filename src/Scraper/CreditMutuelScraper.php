<?php

namespace Scraperize\Scrapper\CreditMutuelScraper;

use \Scraperize\UniversalScraper\AbstractScraper;

/**
 * Class CreditMutuelScraper
 */
class CreditMutuelScraper extends AbstractScraper
{
    /** @var string */
    private const BASE_URI = 'https://www.creditmutuel.fr';

    /**
     * auth
     *
     * @param string $username
     * @param string $password
     *
     * @return $this
     */
    public function auth(string $username, string $password): self
    {
        $this->httpClient
            ->post('/fr/authentification.html', [
                'debug' => true,
                'form_params' => [
                    'flag' => 'password',
                    '_cm_user' => $username,
                    '_cm_pwd' => $password,
                ],
            ])
        ;

        return $this;
    }

    /**
     * downloadCsv
     *
     * @param string $path
     * @param array  $accounts
     *
     * @return $this
     */
    public function downloadCsv(string $path = null, array $accounts = []): self
    {
        $body = $this->httpClient
            ->get('/fr/banque/compte/telechargement.cgi')
            ->getBody()
        ;

        if (!preg_match_all('#<label\s+[^>]*id="F_([0-9]+)\.L13"\s+[^>]*>(.+?)</label>#si', $body, $matches)) {
            return $this;
        }

        if ('' !== $path && !is_dir($path)) {
            mkdir($path, 0775, true);
        }

        foreach ($matches[1] as $i => $number) {

            $account = (string) preg_replace('#[^0-9]+#', '$1', preg_replace('#^([0-9\s]+).+$#', '$1', $matches[2][$i]));

            if (count($accounts)
                && !in_array($account, $accounts, true)) {
                continue;
            }

            if (!preg_match('#<form\s+id="P:F"\s+action="(.+?)"#si', $body, $match)) {
                continue;
            }

            $csv = $this->httpClient
                ->post(html_entity_decode($match[1]), [
                    'form_params' => [
                        'data_formats_selected' => 'csv',
                        'data_formats_options_cmi_download' => '0',
                        'data_formats_options_ofx_format' => '7',
                        'Bool:data_formats_options_ofx_zonetiers' => 'false',
                        'CB:data_formats_options_ofx_zonetiers' => 'on',
                        'data_formats_options_qif_fileformat' => '6',
                        'data_formats_options_qif_dateformat' => '0',
                        'data_formats_options_qif_amountformat' => '0',
                        'data_formats_options_qif_headerformat' => '0',
                        'Bool:data_formats_options_qif_zonetiers' => 'false',
                        'CB:data_formats_options_qif_zonetiers' => 'on',
                        'data_formats_options_csv_fileformat' => '2',
                        'data_formats_options_csv_dateformat' => '0',
                        'data_formats_options_csv_fieldseparator' => '3',
                        'data_formats_options_csv_amountcolnumber' => '1',
                        'data_formats_options_csv_decimalseparator' => '1',
                        'Bool:data_accounts_account_ischecked' => 'false',
                        'Bool:data_accounts_account_2__ischecked' => 'false',
                        'CB:data_accounts_account_' . ($number + 1) . '__ischecked' => 'on',
                        'Bool:data_accounts_account_3__ischecked' => 'false',
                        'Bool:data_accounts_account_4__ischecked' => 'false',
                        'Bool:data_accounts_account_5__ischecked' => 'false',
                        'data_daterange_value' => 'all',
                        '[t:dbt%3adate;]data_daterange_startdate_value' => '',
                        '[t:dbt%3adate;]data_daterange_enddate_value' => '',
                        '_FID_DoDownload.x' => '57',
                        '_FID_DoDownload.y' => '16',
                        'data_accounts_selection' => str_repeat('0', $number) . '1',
                        'data_formats_options_cmi_show' => 'True',
                        'data_formats_options_qif_show' => 'True',
                        'data_formats_options_excel_show' => 'True',
                        'data_formats_options_excel_selected%5fformat' => 'xl-2007',
                        'data_formats_options_csv_show' => 'True'
                    ]
                ])
                ->getBody()
            ;

            file_put_contents($path . $account . '.csv', $csv);
        }

        return $this;
    }
}
