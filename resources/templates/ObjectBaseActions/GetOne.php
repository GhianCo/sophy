<?php

namespace App\Actions\Objectbase;

use App\Model\Objectbase;
use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;
use Sophy\Exceptions\NotFoundException;

class GetOne extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $objectbase = Objectbase::where('objectbase_id', $id)
            ->getOne();
        if (!$objectbase) {
            throw NotFoundException::showMessage('Objectbase con Id #' . $id . ' no encontrado.');
        }
        return $this->respondWithData($objectbase, 'Objectbase encontrado');
    }
}
