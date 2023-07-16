<?php

namespace WinningSoftware\DNSTool;

class QueryHandler
{
    /**
     * @param string $domain
     * @param string $dnsProvider
     *
     * @return string
     */
    public function handleRequest(string $domain, string $dnsProvider = '1.1.1.1'): string
    {
        $command = sprintf('dig %s +short %s', $dnsProvider, $domain);
        exec($command, $output, $error);

        return !$error && isset($output[0]) ? $output[0] : 'unknown';
    }
}