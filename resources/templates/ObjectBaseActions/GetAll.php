<?php

namespace App\Actions\Objectbase;

use App\Consts;
use App\Model\Objectbase;
use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;

class GetAll extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $queryParams = $this->request->getQueryParams();
        $page = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $perPage = isset($queryParams['perPage']) ? (int)$queryParams['perPage'] : Consts::LIMIT_ROWS_COUNT;
        
        $objectbase = Objectbase::paginate($perPage, $page);

        return $this->respondWithData($objectbase->data, 'Lista de objectbase', $objectbase->pagination);
    }
}
