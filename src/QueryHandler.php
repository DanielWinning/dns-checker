<?php

namespace DannyXCII\DnsTool;

class QueryHandler
{
    /**
     * @param string $domain
     * @param string $type
     * @param string $dnsProvider
     *
     * @return bool|string
     */
    public function handleRequest(string $domain, string $type = 'A', string $dnsProvider = '1.1.1.1'): bool|string
    {
        $command = sprintf('dig %s +short %s', $dnsProvider, $domain);
        exec($command, $output, $error);

        if ($error) {
            return false;
        }

        return $output[0] ?? 'unknown - did you include the subdomain (www)';
    }
}