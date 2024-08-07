<?php

use App\Actions\DefaultAction;
use App\Actions\PDFAction;
use App\Actions\ViewAction;

app()->router->get('/', DefaultAction::class);
app()->router->get('/view', ViewAction::class);
app()->router->get('/pdf', PDFAction::class);