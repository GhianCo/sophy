<?php

namespace App\Actions\Objectbase;

use App\Model\Objectbase;
use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;

class Create extends Action
{

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $objectbase = Objectbase::create($this->getFormData());
        return $this->respondWithData($objectbase->save(), 'Objectbase creado con éxito');
    }
}
