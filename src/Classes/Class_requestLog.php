<?php

// https://gist.github.com/magnetikonline/650e30e485c0f91f2f40
class DumpHTTPRequestToFile {

    public function execute($targetFile) {
        $data = "\nRequest body:\n\n\n--------";
        $data .= date("D M d, Y G:i");
        $data .= "---------\n\n";
        $data .= sprintf(
                "%s %s %s\n\nHTTP headers:\n", $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_SERVER['SERVER_PROTOCOL']
        );
        foreach ($this->getHeaderList() as $name => $value) {
            $data .= $name . ': ' . $value . "\n";
        }

        file_put_contents(
                $targetFile, $data . file_get_contents('php://input') . "\n", FILE_APPEND
        );
    }

    private function getHeaderList() {
        $headerList = [];
        foreach ($_SERVER as $name => $value) {
            if (preg_match('/^HTTP_/', $name)) {
                // convert HTTP_HEADER_NAME to Header-Name
                $name = strtr(substr($name, 5), '_', ' ');
                $name = ucwords(strtolower($name));
                $name = strtr($name, ' ', '-');
                // add to list
                $headerList[$name] = $value;
            }
        }
        return $headerList;
    }

}
