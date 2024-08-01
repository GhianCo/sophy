<?php

namespace App\Actions\Objectbase;

use App\Model\Objectbase;
use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;

class Update extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $objectbase = Objectbase::update($this->getFormData(), $this->resolveArg('id'));
        return $this->respondWithData($objectbase->save(), 'Objectbase actualizado con éxito');
    }
}
