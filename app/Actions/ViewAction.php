<?php

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Sophy\Actions\Action;

class ViewAction extends Action
{
    protected function action(): Response
    {
        return $this->view('home');
    }
}

?>