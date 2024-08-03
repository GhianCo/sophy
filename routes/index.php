<?php

use App\Actions\DefaultAction;
use App\Actions\ViewAction;

app()->router->get('/', DefaultAction::class);
app()->router->get('/view', ViewAction::class);