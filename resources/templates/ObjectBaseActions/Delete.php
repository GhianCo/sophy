<?php

namespace App\Actions\Objectbase;

use App\Model\Objectbase;
use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;
use Sophy\Exceptions\NotFoundException;

class Delete extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $objectbase = Objectbase::where('objectbase_id', $id)->delete();

        if (!$objectbase) {
            throw NotFoundException::showMessage('Objectbasee con Id #' . $id . ' no encontrado.');
        }

        return $this->respondWithData(true, 'Objectbase eliminado con éxito');
    }
}
