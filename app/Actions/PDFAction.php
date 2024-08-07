<?php

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;

class PDFAction extends Action
{
    protected function action(): Response
    {
        $queryParams = $this->request->getQueryParams();
        $page = $queryParams['page'] ?? 'reporte';
        $name = $queryParams['name'] ?? '';
        $dest = $queryParams['dest'] ?? 'I';

        return $this->pdf($page, $name, $dest);
    }
}

?>